<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPage extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
