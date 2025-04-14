<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
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
            new Middleware('auth', only: ['create', 'store']),
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
    public function store(Request $request)
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

        $data['user_id'] = auth()->id();

        $article = Article::create($data);

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
    public function destroy(string $id)
    {
        //
    }
}
