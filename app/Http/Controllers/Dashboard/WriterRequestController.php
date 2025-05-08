<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\UserType;
use App\Enum\WriterRequestStatus;
use App\Http\Controllers\Controller;
use App\Models\WriterRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WriterRequestController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('can:articles_categories_show', only: ['index']),
            new Middleware('can:articles_categories_edit', only: ['edit', 'update']),
            new Middleware('can:articles_categories_delete', only: ['destroy']),
            new Middleware('can:articles_categories_create', only: ['store']),
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $quotes = WriterRequest::get();
            return DataTables::of($quotes)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                ( Auth::user()->hasPermissionTo('writer_requests_edit') && $row['status'] == WriterRequestStatus::PENDING->value ?
                "
                    <button class='remove_button approve' data-id='". $row['id'] ."'><i class='ri-check-double-line text-success fs-4' type='submit'></i></button>
                    <button class='remove_button reject' data-id='". $row['id'] ."'><i class='ri-close-circle-line text-danger fs-4' type='submit'></i></button>
                ":"")
                .
                ( Auth::user()->hasPermissionTo('writer_requests_delete') ?
                "
                    <form data-id='".$row['id']."'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='_token' value='" . csrf_token() . "'>
                        <button class='remove_button remove_button_action' type='button'><i class='ri-delete-bin-5-line text-danger fs-4'></i></button>
                    </form>
                ":"")
                .
                "</div>";
            })
            ->editColumn('status', function(WriterRequest $writer_request){
                return match($writer_request->status)
                {
                    WriterRequestStatus::PENDING->value => "<span class='badge text-bg-warning'>" . __('dashboard.' . $writer_request->status) . "</span>",
                    WriterRequestStatus::APPROVED->value => "<span class='badge text-bg-success'>" . __('dashboard.' . $writer_request->status) . "</span>",
                    WriterRequestStatus::REJECTED->value => "<span class='badge text-bg-danger'>" . __('dashboard.' . $writer_request->status) . "</span>"
                };
            })
            ->editColumn('user', function(WriterRequest $writer_request){
                return "
                    <div class='d-flex align-items-center gap-2'>
                        <img src='" . asset($writer_request->user->display_image) ."' width='40' height='40' class='rounded-5'>
                        <span>{$writer_request->user->full_name} ". (Auth::id() == $writer_request->user->id ? '(You)' : '') ."</span>
                    </div>
                ";
            })
            ->rawColumns(['status', 'user', 'action'])
            ->make(true);
        }
        return view('dashboard.writer-requests.index');
    }

    public function approve(WriterRequest $writer_request)
    {
        if($writer_request->status != WriterRequestStatus::PENDING->value)
        {
            return response()->json([
                'errors' => [
                    'only-pending' => [__('front.only-pending-requests')]
                ]
            ], 301);
        }

        $writer_request->status = WriterRequestStatus::APPROVED->value;
        $writer_request->save();

        $writer_request->user->type = UserType::WRITER->value;
        $writer_request->user->save();

        return response()->json([
            'message' => __('dashboard.writer-request-approved')
        ]);
    }

    public function reject(WriterRequest $writer_request)
    {
        if($writer_request->status != WriterRequestStatus::PENDING->value)
        {
            return response()->json([
                'errors' => [
                    'only-pending' => [__('front.only-pending-requests')]
                ]
            ], 301);
        }

        $writer_request->status = WriterRequestStatus::REJECTED->value;
        $writer_request->save();

        $writer_request->user->type = UserType::WRITER->value;
        $writer_request->user->save();
        
        return response()->json([
            'message' => __('dashboard.writer-request-rejected')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WriterRequest $writer_request)
    {
        $writer_request->delete();
    }
}
