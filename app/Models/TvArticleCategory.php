<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as ContractsTranslatable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TvArticleCategory extends Model implements ContractsTranslatable
{
    use Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['title'];

}
