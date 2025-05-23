<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = [];

    public function pages()
    {
        return $this->hasMany(AdPage::class);
    }

    public function categories()
    {
        return $this->hasMany(AdCategory::class);
    }

    public function mediaCategories()
    {
        return $this->hasMany(AdMediaCategory::class);
    }

    public function weight()
    {
        return $this->hasMany(AdWeights::class)->count();
    }
}
