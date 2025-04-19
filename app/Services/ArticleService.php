<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function get_articles($last_article_id = null, $limit = 10)
    {
        $articles = Article::orderBy('id')->when($last_article_id, function($query) use ($last_article_id) {
            return $query->where('id', '>', $last_article_id);
        })->limit($limit)->get();

        return $articles;
    }

    function extractHashtags($text)
    {
        preg_match_all('/#([\p{L}\p{N}_]+)/u', $text, $matches);
        return $matches[1];
    }
}
