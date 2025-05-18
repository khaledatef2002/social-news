<?php

namespace App\Services;

use App\Enum\UserType;
use App\Models\User;

class WritersService
{
    public function get_writers($last_writer_id = null, $limit = 20, $search = null)
    {
        $writers = User::selectRaw('users.*, (select count(*) from articles where articles.user_id = users.id) as articles_count')
            ->where('type', UserType::WRITER->value)
            ->orderByDesc('id')
            ->orderByDesc('articles_count')
            ->when($search, function($query) use ($search) {
                return $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
            })
            ->when($last_writer_id, function($query) use ($last_writer_id) {
                return $query->where('id', '<', $last_writer_id);
            })->limit($limit)->get();

        return $writers;
    }
}
