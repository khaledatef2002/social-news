<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ArticlesCategoriesController extends Controller implements HasMiddleware
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
            $quotes = ArticleCategory::get();
            return DataTables::of($quotes)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                ( Auth::user()->hasPermissionTo('articles_categories_edit') ?
                "
                    <button class='remove_button openEditCategory' data-id='". $row['id'] ."'><i class='ri-settings-5-line fs-4' type='submit'></i></button>
                ":"")
                .
                ( Auth::user()->hasPermissionTo('articles_categories_delete') ?
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
            ->editColumn('title', function(ArticleCategory $category){
                return $category->title;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('dashboard.articles.categories');
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

        ArticleCategory::create($data);

        return response()->json([
            'message' => __('response.article-category-created'),
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
    public function edit(ArticleCategory $articles_category)
    {
        return response()->json([
            'message' => __('response.article-category-found'),
            'category' => $articles_category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticleCategory $articles_category)
    {
        $data = $request->validate([
            'ar.title' => ['required', 'min:2'],
            'en.title' => ['required', 'min:2']
        ]);

        $articles_category->update($data);

        return response()->json([
            'message' => __('response.article-category-updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleCategory $articles_category)
    {
        $articles_category->delete();

        return response()->json([
            'message' => __('response.article-category-deleted'),
        ]);
    }
}
