<?php

namespace App\Services;

use App\Models\AdWeights;

class AdService
{
    public function getByPage($page)
    {
        $ad = AdWeights::whereHas('ad', function($query) use ($page) {
            return $query->whereHas('pages', function($q) use ($page) {
                return $q->where('page', $page);
            })
            ->where(function($q){
                return $q->where('is_counted', false)
                    ->orWhere('max_views', '>', '0');
            })
            ->where(function($t_q){
                $currentDateTime = now()->format('Y-m-d H:i:s');
                return $t_q->where('start_date', null)->orWhere('start_date', '<=', $currentDateTime)
                    ->where('end_date', null)->orWhere('end_date', '>=', $currentDateTime);
            });
        })
        ->inRandomOrder()
        ->first()
        ?->ad()
        ?->first();
        
        if($ad)
        {
            if($ad->is_counted) {
                $ad->max_views = $ad->max_views - 1;
            }
            $ad->current_views = $ad->current_views + 1;
            $ad->save();
        }

        return $ad;
    }

    public function getByCategory($category_id)
    {
        $ad = AdWeights::whereHas('ad', function($query) use ($category_id) {
            return $query->whereHas('categories', function($q) use ($category_id) {
                return $q->where('category_id', $category_id);
            })
            ->where(function($q){
                return $q->where('is_counted', false)
                    ->orWhere('max_views', '>', '0');
            })
            ->where(function($t_q){
                $currentDateTime = now()->format('Y-m-d H:i:s');
                return $t_q->where('start_date', null)->orWhere('start_date', '<=', $currentDateTime)
                    ->where('end_date', null)->orWhere('end_date', '>=', $currentDateTime);
            });
        })
        ->inRandomOrder()
        ->first()
        ?->ad()
        ?->first();
        
        if($ad)
        {
            if($ad->is_counted) {
                $ad->max_views = $ad->max_views - 1;
            }
            $ad->current_views = $ad->current_views + 1;
            $ad->save();
        }

        return $ad;
    }

    public function getByTvCategory($category_id)
    {
        $ad = AdWeights::whereHas('ad', function($query) use ($category_id) {
            return $query->whereHas('mediaCategories', function($q) use ($category_id) {
                return $q->where('category_id', $category_id);
            })
            ->where(function($q){
                return $q->where('is_counted', false)
                    ->orWhere('max_views', '>', '0');
            })
            ->where(function($t_q){
                $currentDateTime = now()->format('Y-m-d H:i:s');
                return $t_q->where('start_date', null)->orWhere('start_date', '<=', $currentDateTime)
                    ->where('end_date', null)->orWhere('end_date', '>=', $currentDateTime);
            });
        })
        ->inRandomOrder()
        ->first()
        ?->ad()
        ?->first();

        if($ad)
        {
            if($ad->is_counted) {
                $ad->max_views = $ad->max_views - 1;
            }
            $ad->current_views = $ad->current_views + 1;
            $ad->save();
        }

        return $ad;
    }
}
