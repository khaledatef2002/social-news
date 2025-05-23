<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdCategory extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function ads()
    {
        return $this->belongsTo(Ad::class);
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
