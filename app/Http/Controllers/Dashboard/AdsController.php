<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\AdPages;
use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdCategory;
use App\Models\AdMediaCategory;
use App\Models\AdPage;
use App\Models\AdWeights;
use App\Models\TvArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $ads = Ad::get();
            return DataTables::of($ads)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                ( Auth::user()->hasPermissionTo('ads_edit') ?
                "<a href='" . route('dashboard.ads.edit', $row) . "'><i class='ri-settings-5-line fs-4' type='submit'></i></a>    "
                :"")
                .
                ( Auth::user()->hasPermissionTo('ads_delete') ?
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
            ->editColumn('cover', function($row){
                return "<div style='height: 100px;display: flex;justify-content: center;aspect-ratio: 1 / 0.45;overflow: hidden;'><img src='" . asset($row['cover']) ."' style='min-width: 100%;min-height: 100%;object-fit: cover;'></div>";
            })
            ->editColumn('redirect_link', function($row){
                return "<a href='" . $row['redirect_link'] . "' target='_blank'>" . $row['redirect_link'] . "</a>";
            })
            ->editColumn('weight', function(Ad $ad){
                return $ad->weight();
            })
            ->rawColumns(['cover', 'redirect_link', 'action'])
            ->make(true);
        }
        return view('dashboard.ads.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'title' => 'required',
            'redirect_link' => 'required|url',
            'weight' => 'required|numeric|in:1,2,3,4,5',
            'pages' => 'nullable|array',
            'pages.*' => ['required', Rule::in(AdPages::list())],
            'articles_categories' => 'nullable|array',
            'articles_categories.*' => ['required', 'exists:article_categories,id'],
            'media_categories' => 'nullable|array',
            'media_categories.*' => ['required', 'exists:tv_article_categories,id'],
        ]);

        $image = $request->file('cover');
        $imagePath = 'ads/' . uniqid() . '.webp';
    
        $manager = new ImageManager(new Driver());
        $manager->read($image)
            ->scale(height: 450)
            ->encode(new AutoEncoder('webp', quality: 75))
            ->save('storage/' . $imagePath);
            
        $url = Storage::url($imagePath);
        
        $data['cover'] = $url;

        $ads = Ad::create([
            'title' => $data['title'],
            'cover' => $data['cover'],
            'redirect_link' => $data['redirect_link'],
        ]);

        for($i = 0; $i < $data['weight']; $i++)
        {
            AdWeights::create([
                'ad_id' => $ads->id,
            ]);
        }

        if($data['pages'])
        {
            foreach($data['pages'] as $page)
            {
                AdPage::create([
                    'ad_id' => $ads->id,
                    'page' => $page,
                ]);
            }
        }

        if($data['articles_categories'])
        {
            foreach($data['articles_categories'] as $category)
            {
                AdCategory::create([
                    'ad_id' => $ads->id,
                    'category_id' => $category,
                ]);
            }
        }

        if($data['media_categories'])
        {
            foreach($data['media_categories'] as $category)
            {
                AdMediaCategory::create([
                    'ad_id' => $ads->id,
                    'category_id' => $category,
                ]);
            }
        }

        return response()->json([
            'message' => __('response.add-created'),
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
    public function edit(Ad $ad)
    {
        return view('dashboard.ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ad $ad)
    {
        $data = $request->validate([
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'title' => 'required',
            'redirect_link' => 'required|url',
            'weight' => 'required|numeric|in:1,2,3,4,5',
            'pages' => 'nullable|array',
            'pages.*' => ['required', Rule::in(AdPages::list())],
            'articles_categories' => 'nullable|array',
            'articles_categories.*' => ['required', 'exists:article_categories,id'],
            'media_categories' => 'nullable|array',
            'media_categories.*' => ['required', 'exists:tv_article_categories,id'],
        ]);

        if($request->file('cover'))
        {
            if(Storage::disk('public')->exists($ad->cover ?? ''))
            {
                Storage::disk('public')->delete($ad->cover ?? '');
            }

            $image = $request->file('cover');
            $imagePath = 'ads/' . uniqid() . '.webp';
        
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->scale(height: 450)
                ->encode(new AutoEncoder('webp', quality: 75))
                ->save('storage/' . $imagePath);
                
            $url = Storage::url($imagePath);
            
            $data['cover'] = $url;

            $ad->cover = $url;
        }

        $ad->title = $data['title'];
        $ad->redirect_link = $data['redirect_link'];

        $ad->save();

        AdWeights::where('ad_id', $ad->id)->delete();
        for($i = 0; $i < $data['weight']; $i++)
        {
            AdWeights::create([
                'ad_id' => $ad->id,
            ]);
        }

        $ad->pages()->delete();
        if($data['pages']) 
        {
            foreach($data['pages'] as $page)
            {
                AdPage::create([
                    'ad_id' => $ad->id,
                    'page' => $page,
                ]);
            }
        }

        $ad->categories()->delete();
        if($data['articles_categories'])
        {
            foreach($data['articles_categories'] as $category)
            {
                AdCategory::create([
                    'ad_id' => $ad->id,
                    'category_id' => $category,
                ]);
            }
        }

        $ad->mediaCategories()->delete();
        if($data['media_categories'])
        {
            foreach($data['media_categories'] as $category)
            {
                AdMediaCategory::create([
                    'ad_id' => $ad->id,
                    'category_id' => $category,
                ]);
            }
        }

        return response()->json([
            'message' => __('response.add-created'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        if(Storage::disk('public')->exists($ads->image ?? ''))
        {
            Storage::disk('public')->delete($ads->image ?? '');
        }

        $ads->delete();
    }
}
