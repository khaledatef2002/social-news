<?php

namespace App\Http\Controllers\Front;

use App\Enum\AdPages;
use App\Http\Controllers\Controller;
use App\Services\AdService;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticlesSummaryController extends Controller
{
    public function index(ArticleService $article_service, AdService $ad_service)
    {
        $first_articles = $article_service->get_articles();
        $ad = $ad_service->getByPage(AdPages::Summaries->value);
        return view('front.articles.summary', compact('first_articles', 'ad'));
    }
}
