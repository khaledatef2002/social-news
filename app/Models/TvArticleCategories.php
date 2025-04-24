<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TvArticleCategories extends Model implements ContractsTranslatable
{
    use Translatable;

    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'tv_article_category_id';

}
