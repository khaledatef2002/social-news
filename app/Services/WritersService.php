<?php

namespace App\Services;

use App\Enum\UserType;
use App\Models\User;

class WritersService
{
    public function get_writers($offset = 0, $limit = 20, $search = null)
    {
        $writers = User::withCount('articles')
            ->where('type', UserType::WRITER->value)
            ->orderByDesc('articles_count')
            ->orderByDesc('id')
            ->when($search, function($query) use ($search) {
                return $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
            })
            ->limit($limit)->offset($offset)->get();

        return $writers;
    }
}
