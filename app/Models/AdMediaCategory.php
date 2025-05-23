<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdMediaCategory extends Model
{
    protected $guarded = [];

    public $timestamps = false;
    
    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

    public function category()
    {
        return $this->belongsTo(TvArticleCategory::class);
    }
}
