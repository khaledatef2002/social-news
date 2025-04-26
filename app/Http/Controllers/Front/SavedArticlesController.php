<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class SavedArticlesController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth')
        ];
    }
    
    public function index()
    {
        $first_articles = Auth::user()->saved_articles()->limit(20)->orderByDesc('id')->get();

        return view('front.saved-articles.index', compact('first_articles'));
    }

    public function getMoreArticles(Int $last_article_id, Int $limit, ArticleService $article_service)
    {
        $articles = Auth::user()->saved_articles()->where('id', '>', $last_article_id)->limit(20)->orderByDesc('id')->get();

        if($articles->count() > 0)
        {
            return response()->json([
                'message' => __('create.message.success'),
                'content' => view('components.article-list', compact('articles'))->render(),
                'length' => $articles->count() >= $limit ? $limit : $articles->count()
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['data' => ['لا يوجد نتائج']]
            ], 404);
        }
    }
}
