<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleHashtags;
use App\Models\ArticleImage;
use App\Models\UserSavedArticle;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class ArticlesController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth', only: ['create', 'store', 'edit', 'update', 'destroy', 'bookmark']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('front.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ArticleService $article_service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'short' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:article_categories,id',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'keywords' => 'required|string|max:255',
            'source' => 'nullable|url|max:255',
            'images.*' => 'required|exists:article_images,id',
        ]);

        $image = $request->file('cover');
        $imagePath = 'articles/covers/' . uniqid() . '.webp';

        $date = now()->format('Y-m-d-H-i-s');

        $manager = new ImageManager(new Driver());
        $manager->read($image)
            ->scale(height: 450)
            ->encode(new AutoEncoder('webp', quality: 75))
            ->save('storage/' . $imagePath);
            
        $url = Storage::url($imagePath);
        
        $data['cover'] = $url;

        $data['slug'] = Str::of($data['title'] . '-' . $date)->trim()->lower()->replace(' ', '-');

        $data['user_id'] = Auth::id();

        $hashtags = $article_service->extractHashtags($data['content']);

        $article = Article::create($data);

        foreach ($hashtags as $hashtag)
        {
            ArticleHashtags::firstOrCreate([
                'article_id' => $article->id,
                'hashtag' => $hashtag
            ]);
        }

        foreach ($request->images as $image) {
            $imageModel = ArticleImage::find($image);
            if ($imageModel) {
                $imageModel->update([
                    'article_id' => $article->id,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => __('create.message.success'),
            'url' => route('front.articles.show', $article->slug),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(Article $article)
    {
        foreach($article->images as $image)
        {
            if(Storage::disk('public')->exists($image->path))
            {
                Storage::dish('public')->delete($image->path);
            }
        }

        if(Storage::disk('public')->exists($article->cover))
        {
            Storage::disk('public')->delete($article->path);
        }

        $article->delete();

        return response()->json([
            'message' => __('create.message.success'),
        ]);
    }

    public function getMoreArticles(Int $last_article_id, Int $limit, ArticleService $article_service)
    {
        $articles = $article_service->get_articles($last_article_id, $limit);

        if($articles->count() > 0)
        {
            return response()->json([
                'message' => __('create.message.success'),
                'content' => view('components.article-list', compact('articles'))->render(),
                'length' => $articles->count() >= 10 ? 10 : $articles->count()
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['data' => ['لا يوجد نتائج']]
            ], 404);
        }
    }
    public function getMoreArticlesSummary(Int $last_article_id, Int $limit, ArticleService $article_service)
    {
        $articles = $article_service->get_articles($last_article_id, $limit);

        if($articles->count() > 0)
        {
            return response()->json([
                'message' => __('create.message.success'),
                'content' => view('components.article-summary-list', compact('articles'))->render(),
                'length' => $articles->count() >= 10 ? 10 : $articles->count()
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['data' => ['لا يوجد نتائج']]
            ], 404);
        }
    }

    public function bookmark(Article $article)
    {
        $bookmarked = false;
        $article_saved = UserSavedArticle::where('article_id', $article->id)->where('user_id', Auth::id());
        if($article_saved->count() > 0)
        {
            $article_saved->first()->delete();
        }
        else
        {
            UserSavedArticle::create([
                'article_id' => $article->id,
                'user_id' => Auth::id()
            ]);

            $bookmarked = true;
        }

        return response()->json([
            'message' => __('create.message.success'),
            'bookmarked' => $bookmarked,
        ]);
    }
}
