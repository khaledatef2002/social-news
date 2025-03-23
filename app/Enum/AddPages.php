<?php

namespace App\Enum;

enum AddPages: string
{
    case HOME = 'home';
    case articles = 'articles';
    case single_article = 'single_article';
    case opinion_article = 'opinion_article';
}
