<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TvArticle extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['title'];

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(TvArticleCategory::class);
    }

    public function getEmbedSourceAttribute()
    {
        $parsedUrl = parse_url($this->source);

        if (!isset($parsedUrl['host'])) {
            return '';
        }

        $host = $parsedUrl['host'];

        // Handle short YouTube URL
        if ($host === 'youtu.be') {
            $videoId = ltrim($parsedUrl['path'], '/');
            return "https://www.youtube.com/embed/" . $videoId;
        }

        // Handle long YouTube URL
        if (strpos($host, 'youtube.com') !== false && isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
            if (isset($queryParams['v'])) {
                return "https://www.youtube.com/embed/" . $queryParams['v'];
            }
        }

        return '';
    }
}
