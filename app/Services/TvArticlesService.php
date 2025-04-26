<?php

namespace App\Services;

use App\Models\TvArticle;

class TvArticlesService
{
    public function get_tv_articles($last_article_id = null, $limit = 20)
    {
        $articles = TvArticle::orderByDesc('id')->when($last_article_id, function($query) use ($last_article_id) {
            return $query->where('id', '<', $last_article_id);
        })->limit($limit)->get();

        return $articles;
    }
}
