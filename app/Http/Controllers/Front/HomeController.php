<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(ArticleService $article_service)
    {
        $first_articles = $article_service->get_articles();
        return view('front.home', compact('first_articles'));
    }
}
