<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use Translatable;

    public $translatedAttributes = ['title'];
    protected $guarded = [];

}
