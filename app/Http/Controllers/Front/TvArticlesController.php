<?php

namespace App\Http\Controllers\Front;

use App\Enum\AdPages;
use App\Http\Controllers\Controller;
use App\Models\TvArticle;
use App\Services\AdService;
use App\Services\TvArticlesService;
use Illuminate\Http\Request;

class TvArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TvArticlesService $article_service, AdService $ad_service)
    {
        $first_tv_articles = $article_service->get_tv_articles();
        $ad = $ad_service->getByPage(AdPages::Media->value);
        return view('front.tv.index', compact('first_tv_articles', 'ad'));
    }

    public function getMoreTvArticles(Int $last_tv_article_id, Int $limit, TvArticlesService $article_service)
    {
        $articles = $article_service->get_tv_articles($last_tv_article_id, $limit);

        if($articles->count() > 0)
        {
            return response()->json([
                'message' => __('response.get-more-articles-success'),
                'content' => view('components.tv-article-list', compact('articles'))->render(),
                'length' => $articles->count() >= $limit ? $limit : $articles->count()
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['data' => [__('response.no-articles')]]
            ], 404);
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TvArticle $article, AdService $ad_service)
    {
        $ad = $ad_service->getByTvCategory($article->category_id);
        return view('front.tv.show', compact('article', 'ad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
