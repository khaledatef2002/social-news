<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TvArticle;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TvArticlesController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('can:tv_articles_show', only: ['index']),
            new Middleware('can:tv_articles_edit', only: ['edit', 'update']),
            new Middleware('can:tv_articles_delete', only: ['destroy']),
            new Middleware('can:tv_articles_create', only: ['create', 'store']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $articles = TvArticle::get();
            return DataTables::of($articles)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                "<a href='" . route('front.tv-articles.show', $row) . "' target='_blank'><i class='ri-eye-line fs-4' type='submit'></i></a>"
                .  
                ( Auth::user()->hasPermissionTo('tv_articles_edit') ?
                "<a href='" . route('dashboard.tv-articles.edit', $row) . "'><i class='ri-settings-5-line fs-4' type='submit'></i></a>    "
                :"")
                .
                ( Auth::user()->hasPermissionTo('tv_articles_delete') ?
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
            ->editColumn('source', function(TvArticle $article){
                return "<a href='" . $article->source . "' target='_blank'>" . $article->source . "</a>";
            })
            ->rawColumns(['source', 'action'])
            ->make(true);
        }
        return view('dashboard.tv-articles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.tv-articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'en.title' => 'required|string|max:255',
            'ar.title' => 'required|string|max:255',
            'source' => 'nullable|url|max:255',
            'category_id' => 'required|exists:tv_article_categories,id',
            'keywords' => 'required|string|max:255',
        ]);

        $article = TvArticle::create($data);

        return response()->json([
            'message' => __('response.tv-article-created'),
            'url' => route('dashboard.tv-articles.edit', $article)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TvArticle $tv_article)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TvArticle $tv_article)
    {
        return view('dashboard.tv-articles.edit', compact('tv_article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TvArticle $tv_article)
    {
        $data = $request->validate([
            'en.title' => 'required|string|max:255',
            'ar.title' => 'required|string|max:255',
            'source' => 'nullable|url|max:255',
            'category_id' => 'required|exists:tv_article_categories,id',
            'keywords' => 'required|string|max:255',
        ]);

        $tv_article->update($data);

        return response()->json([
            'message' => __('response.tv-article-created'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TvArticle $tv_article)
    {
        $tv_article->delete();
    }
}
