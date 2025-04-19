<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleReact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesReactsController extends Controller
{
    public function react(Article $article)
    {
        $reacted = false;
        $article_react = ArticleReact::where('article_id', $article->id)->where('user_id', Auth::id());
        if($article_react->count() > 0)
        {
            $article_react->first()->delete();
        }
        else
        {
            ArticleReact::create([
                'article_id' => $article->id,
                'user_id' => Auth::id()
            ]);

            $reacted = true;
        }

        return response()->json([
            'message' => __('create.message.success'),
            'reacted' => $reacted,
            'count' => $article->reacts->count()
        ]);
    }
}
