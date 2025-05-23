<?php

namespace App\Enum;

enum AddPages: string
{
    case HOME = 'home';
    case articles = 'articles';
    case single_article = 'single_article';
    case opinion_article = 'opinion_article';

    public static function list(): array
    {
        return [
            self::HOME->value,
            self::articles->value,
            self::single_article->value,
            self::opinion_article->value,
        ];
    }
}
