<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticlesController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('can:articles_show', only: ['index']),
            new Middleware('can:articles_delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $articles = Article::get();
            return DataTables::of($articles)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                "<a href='" . route('front.articles.show', $row) . "' target='_blank'><i class='ri-eye-line fs-4' type='submit'></i></a>"
                .  
                (Auth::user()->hasPermissionTo('articles_delete') ?
                "
                    <form data-id='".$row['id']."'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='_token' value='" . csrf_token() . "'>
                        <button class='remove_button remove_button_action' type='button'><i class='ri-delete-bin-5-line text-danger fs-4'></i></button>
                    </form>
                ":"")
                .
                "</div>";
            })
            ->editColumn('cover', function(Article $article){
                return "<div style='height: 100px;display: flex;justify-content: center;aspect-ratio: 1 / 0.45;overflow: hidden;'><img src='" . asset($article->cover) ."' style='min-width: 100%;min-height: 100%;object-fit: cover;'></div>";
            })
            ->editColumn('category', function(Article $article){
                return $article->category->title;
            })
            ->editColumn('reacts', function(Article $article){
                return $article->reacts()->count();
            })
            ->editColumn('user', function(Article $article){
                return "
                    <div class='d-flex align-items-center gap-2'>
                        <img src='" . asset($article->user->display_image) ."' width='40' height='40' class='rounded-5'>
                        <span>{$article->user->full_name} ". (Auth::id() == $article->user->id ? '(You)' : '') ."</span>
                    </div>
                ";
            })
            ->rawColumns(['cover', 'user', 'action'])
            ->make(true);
        }
        return view('dashboard.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
            'message' => __('response.delete-article-success'),
        ]);
    }
}
