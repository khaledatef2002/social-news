<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TvArticleCategory;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TvArticlesCategoriesController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('can:tv_articles_categories_show', only: ['index']),
            new Middleware('can:tv_articles_categories_edit', only: ['edit', 'update']),
            new Middleware('can:tv_articles_categories_delete', only: ['destroy']),
            new Middleware('can:tv_articles_categories_create', only: ['store']),
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $quotes = TvArticleCategory::get();
            return DataTables::of($quotes)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                ( Auth::user()->hasPermissionTo('tv_articles_categories_edit') ?
                "
                    <button class='remove_button openEditCategory' data-id='". $row['id'] ."'><i class='ri-settings-5-line fs-4' type='submit'></i></button>
                ":"")
                .
                ( Auth::user()->hasPermissionTo('tv_articles_categories_delete') ?
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
            ->editColumn('title', function(TvArticleCategory $category){
                return $category->title;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('dashboard.tv-articles.categories');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ar.title' => ['required', 'min:2'],
            'en.title' => ['required', 'min:2']
        ]);

        TvArticleCategory::create($data);

        return response()->json([
            'message' => __('response.tv-article-category-created'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TvArticleCategory $tv_articles_category)
    {
        return response()->json([
            'message' => __('response.tv-article-category-found'),
            'category' => $tv_articles_category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TvArticleCategory $tv_articles_category)
    {
        $data = $request->validate([
            'ar.title' => ['required', 'min:2'],
            'en.title' => ['required', 'min:2']
        ]);

        $tv_articles_category->update($data);

        return response()->json([
            'message' => __('response.tv-article-category-updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TvArticleCategory $tv_articles_category)
    {
        $tv_articles_category->delete();

        return response()->json([
            'message' => __('response.tv-article-category-deleted'),
        ]);
    }
}
