<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdWeights extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
