<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\WritersService;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Writer;

class WritersController extends Controller
{
    public function index(WritersService $writers_service)
    {
        $first_writers = $writers_service->get_writers();
        return view('front.writers.index', compact('first_writers'));
    }

    public function getMoreWriters(Int $offset, Int $limit, WritersService $writer_service, Request $request)
    {
        $writers = $writer_service->get_writers($offset, $limit, $request->search ?? null);

        if($writers->count() > 0)
        {
            return response()->json([
                'message' => __('response.get-more-writers-success'),
                'content' => view('components.writers-list', compact('writers'))->render(),
                'length' => $writers->count() >= $limit ? $limit : $writers->count()
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['data' => [__('response.no-writers')]]
            ], 404);
        }
    }

    public function search(WritersService $writers_service, Request $request)
    {
        $first_writers = $writers_service->get_writers(search: $request->search ?? null);

        if($first_writers->count() > 0)
        {
            return response()->json([
                'message' => __('response.get-more-writers-success'),
                'content' => view('components.writers-list', ['writers' => $first_writers])->render(),
                'length' => $first_writers->count() >= 20 ? 20 : $first_writers->count()
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['data' => [__('response.no-writers')]]
            ], 404);
        }
    }
}
