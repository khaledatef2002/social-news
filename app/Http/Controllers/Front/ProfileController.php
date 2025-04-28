<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $profile)
    {
        $first_articles = $profile->articles()->limit(20)->orderByDesc('id')->get();
        return view('front.profile.show', ['user' => $profile, 'first_articles' => $first_articles]);
    }

    public function getMoreArticles(User $user, Int $last_article_id, Int $limit)
    {
        $articles = $user->articles()->where('id', '>', $last_article_id)->limit(20)->orderByDesc('id')->get();

        if($articles->count() > 0)
        {
            return response()->json([
                'message' => __('create.message.success'),
                'content' => view('components.profile-article-list', compact('articles'))->render(),
                'length' => $articles->count() >= $limit ? $limit : $articles->count()
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['data' => ['لا يوجد نتائج']]
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
