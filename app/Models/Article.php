<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function reacts()
    {
        return $this->hasMany(ArticleReact::class);
    }

    public function images()
    {
        return $this->hasMany(ArticleImage::class);
    }

    public function isAuthReacted()
    {
        if (Auth::user()) {
            return $this->reacts()->where('user_id', Auth::id())->count() > 0;
        }

        return false;
    }
}
