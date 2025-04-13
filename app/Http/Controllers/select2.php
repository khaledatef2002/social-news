<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class select2 extends Controller
{
    public function article_category(Request $request)
    {
        $search = $request->get('q'); 

        $authors = ArticleCategory::when($search, function($query) use ($search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        })
        ->get();

        return response()->json($authors);
    }
}
