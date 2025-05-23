<?php

namespace App\Services;

use App\Models\AdWeights;

class AdService
{
    public function getByPage($page)
    {
        return AdWeights::whereHas('ad', function($query) use ($page) {
            return $query->whereHas('pages', function($q) use ($page) {
                return $q->where('page', $page);
            });
        })
        ->inRandomOrder()
        ->first()
        ?->ad()
        ?->first();
    }

    public function getByCategory($category_id)
    {
        return AdWeights::whereHas('ad', function($query) use ($category_id) {
            return $query->whereHas('categories', function($q) use ($category_id) {
                return $q->where('category_id', $category_id);
            });
        })
        ->inRandomOrder()
        ->first()
        ?->ad()
        ?->first();
    }

    public function getByTvCategory($category_id)
    {
        return AdWeights::whereHas('ad', function($query) use ($category_id) {
            return $query->whereHas('mediaCategories', function($q) use ($category_id) {
                return $q->where('category_id', $category_id);
            });
        })
        ->inRandomOrder()
        ->first()
        ?->ad()
        ?->first();
    }
}
