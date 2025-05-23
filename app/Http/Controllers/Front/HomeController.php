<?php

namespace App\Http\Controllers\Front;

use App\Enum\AdPages;
use App\Http\Controllers\Controller;
use App\Services\AdService;
use App\Services\ArticleService;

class HomeController extends Controller
{
    public function home(ArticleService $article_service, AdService $ad_service)
    {
        $ad = $ad_service->getByPage(AdPages::Home->value);
        $first_articles = $article_service->get_articles();
        return view('front.home', compact('first_articles', 'ad'));
    }
}
