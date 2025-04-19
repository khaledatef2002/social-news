<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticlesSummaryController extends Controller
{
    public function index(ArticleService $article_service)
    {
        $first_articles = $article_service->get_articles();
        return view('front.articles.summary', compact('first_articles'));
    }
}
