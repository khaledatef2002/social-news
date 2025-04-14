<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Illuminate\Support\Str;

class ArticlesImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        
        $image = $request->file('upload');
        $imagePath = 'articles/images/' . uniqid() . '.webp';

        $manager = new ImageManager(new GdDriver());
        $manager->read($image)
            ->scale(height: 350)
            ->encode(new AutoEncoder('webp', quality: 75))
            ->save('storage/' . $imagePath);
            
        $url = Storage::url($imagePath);

        $articleImage = ArticleImage::create([
            'path' => $url,
        ]);

        return response()->json(['url' => $url, 'id' => $articleImage->id]);
    }
}
