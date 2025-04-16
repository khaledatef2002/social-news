<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function get_articles($offset = 0, $limit = 10)
    {
        $articles = Article::orderBy('created_at')->offset($offset)->limit($limit)->get();

        return $articles;
    }

    function extractHashtags($text)
    {
        preg_match_all('/#([\p{L}\p{N}_]+)/u', $text, $matches);
        return $matches[1];
    }
}
