<?php

namespace App\Http\Controllers\Front;

use App\Enum\EducationType;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class ProfileController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['edit', 'update']),
        ];
    }
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
        $articles = $user->articles()->where('id', '<', $last_article_id)->limit(20)->orderByDesc('id')->get();

        if($articles->count() > 0)
        {
            return response()->json([
                'message' => __('response.get-more-articles-success'),
                'content' => view('components.profile-article-list', compact('articles'))->render(),
                'length' => $articles->count() >= $limit ? $limit : $articles->count()
            ]);
        }
        else
        {
            return response()->json([
                'errors' => ['data' => [__('response.no-articles')]]
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $profile)
    {
        if($profile->id != Auth::id())
        {
            abort(301);
        }
        return view('front.profile.edit', ['user' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $profile)
    {
        if($profile->id != Auth::id())
        {
            abort(301);
        }

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',id,'.$profile->id],
            'country_code' => ['required', 'string', 'size:2'],
            'phone' => ['required', 'phone:' . $request->input('country_code'), 'unique:'.User::class.',id,'.$profile->id],
            'password' => ['nullable', Rules\Password::defaults()],
            'nid' => ['nullable', 'numeric'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            'phone_public' => ['required', 'boolean'],

            'education_public' => ['required', 'boolean'],
            'education' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->education_public == 'on') {
                    if (!$value) {
                        $fail(__('You must choose your education before making it visible.'));
                    } elseif (!in_array($value, EducationType::values())) {
                        $fail(__('Please choose a correct education value'));
                    }
                }
            }],

            'position_public' => ['required', 'boolean'],
            'position' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->position_public == 'on') {
                    if (!$value) {
                        $fail(__('You must enter your position before maing it visible.'));
                    }
                }
            }],

            
            'x_link_public' => ['required', 'boolean'],
            'x_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->x_link_public == 'on') {
                    if (!$value) {
                        $fail(__('You must enter your x link before maing it visible.'));
                    }
                }
            }],
            
            'facebook_link_public' => ['required', 'boolean'],
            'facebook_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->facebook_link_public == 'on') {
                    if (!$value) {
                        $fail(__('You must enter your facebook link before maing it visible.'));
                    }
                }
            }],
            
            'instagram_link_public' => ['required', 'boolean'],
            'instagram_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->instagram_link_public == 'on') {
                    if (!$value) {
                        $fail(__('You must enter your instagram link before maing it visible.'));
                    }
                }
            }],
            
            'linkedin_link_public' => ['required', 'boolean'],
            'linkedin_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->linkedin_link_public == 'on') {
                    if (!$value) {
                        $fail(__('You must enter your linkedin link before maing it visible.'));
                    }
                }
            }],

        ]);

        if($image = $request->file('image'))
        {
            $image = $request->file('image');
            $imagePath = 'users/profile-images/' . uniqid() . '.webp';
        
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->scale(height: 450)
                ->encode(new AutoEncoder('webp', quality: 75))
                ->save('storage/' . $imagePath);
                
            $url = Storage::url($imagePath);
            
            $data['image'] = $url;
        }
        else
        {
            unset($data['image']);
        }

        if(!$request->password)
        {
            unset($data['password']);
        }

        $profile->update($data);
        return response()->json([
            'message' => __('response.profile-updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
