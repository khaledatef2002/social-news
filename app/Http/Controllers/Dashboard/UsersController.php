<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\EducationType;
use App\Enum\UserType;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Intervention\Image\Drivers\Gd\Driver;
use Spatie\Permission\Models\Role as ModelsRole;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;
use Spatie\Permission\Models\Role;


class UsersController extends Controller implements HasMiddleware
{
    public static function Middleware()
    {
        return [
            new Middleware('can:users_show', only: ['index']),
            new Middleware('can:users_create', only: ['create', 'store']),
            new Middleware('can:users_edit', only: ['edit', 'update']),
            new Middleware('can:users_delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $quotes = User::get();
            return DataTables::of($quotes)
            ->rawColumns(['action'])
            ->addColumn('action', function(User $user){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                "<a href='" . route('front.profile.show', $user) . "' target='_blank'><i class='ri-eye-line fs-4' type='submit'></i></a>"
                .
                
                (Auth::user()->hasPermissionTo('users_edit') ?
                "<a href='" . route('dashboard.users.edit', $user) . "'><i class='ri-settings-5-line fs-4' type='submit'></i></a>": "")
                .
                (Auth::id() != $user->id ?
                    (Auth::user()->hasPermissionTo('users_delete') ?
                    "
                        <form data-id='".$user->id."'>
                            <input type='hidden' name='_method' value='DELETE'>
                            <input type='hidden' name='_token' value='" . csrf_token() . "'>
                            <button class='remove_button remove_button_action' type='button'><i class='ri-delete-bin-5-line text-danger fs-4'></i></button>
                        </form>
                    "
                    : "")
                : '')
                .
                "</div>";
            })
            ->editColumn('user', function(User $user){
                return "
                    <div class='d-flex align-items-center gap-2'>
                        <img src='" . asset($user->display_image) ."' width='40' height='40' class='rounded-5'>
                        <span>{$user->full_name} ". (Auth::id() == $user->id ? '(You)' : '') ."</span>
                    </div>
                ";
            })
            ->editColumn('type', function(User $user){
                return $user->type == UserType::USER->value ? '<span class="badge bg-primary">'. __("dashboard.member") .'</span>' : '<span class="badge bg-success">'. __("dashboard.writer") .'</span>';
            })
            ->editColumn('admin', function(User $user){
                return $user->admin ? '<span class="badge bg-success">'. __("dashboard.admin") .'</span>' : '<span class="badge bg-danger">'. __("dashboard.not-admin") .'</span>';
            })
            ->editColumn('phone', function(User $user){
                return "+" . $user->country_code . $user->phone;
            })
            ->editColumn('role', function(User $user){
                return $user->admin ? '<span class="badge bg-primary">'. $user->getRoleNames()[0] .'</span>' : '';
            })
            ->rawColumns(['user', 'admin', 'role', 'type', 'action'])
            ->make(true);
        }
        return view('dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = ModelsRole::all();
        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'country_code' => ['required', 'string', 'size:2'],
            'phone' => ['required', 'phone:' . $request->input('country_code'), 'unique:'.User::class],
            'nid' => ['nullable', 'numeric'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            'phone_public' => ['required', 'boolean'],

            'education_public' => ['required', 'boolean'],
            'education' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->education_public == '1') {
                    if (!$value) {
                        $fail(__('You must choose your education before making it visible.'));
                    } elseif (!in_array($value, EducationType::values())) {
                        $fail(__('Please choose a correct education value'));
                    }
                }
            }],

            'position_public' => ['required', 'boolean'],
            'position' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->position_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your position before maing it visible.'));
                    }
                }
            }],

            'x_link_public' => ['required', 'boolean'],
            'x_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->x_link_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your x link before maing it visible.'));
                    }
                }
            }],
            
            'facebook_link_public' => ['required', 'boolean'],
            'facebook_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->facebook_link_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your facebook link before maing it visible.'));
                    }
                }
            }],
            
            'instagram_link_public' => ['required', 'boolean'],
            'instagram_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->instagram_link_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your instagram link before maing it visible.'));
                    }
                }
            }],
            
            'linkedin_link_public' => ['required', 'boolean'],
            'linkedin_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->linkedin_link_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your linkedin link before maing it visible.'));
                    }
                }
            }],

            'type' => ['required', Rule::in(UserType::USER->value, UserType::WRITER->value)],

            'admin' => ['required', 'boolean'],
            'role' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->admin == '1') {
                    if (!$value) {
                        $fail(__('You must enter the user role to make him as admin.'));
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

        $user = User::create($data);
        $role=ModelsRole::find($request->role);
        $user->assignRole($role);

        return response()->json([
            'message' => __('response.profile-updated'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = ModelsRole::all();
        return view('dashboard.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',id,'.$user->id],
            'country_code' => ['required', 'string', 'size:2'],
            'phone' => ['required', 'phone:' . $request->input('country_code'), 'unique:'.User::class.',id,'.$user->id],
            'password' => ['nullable', Rules\Password::defaults()],
            'nid' => ['nullable', 'numeric'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            'phone_public' => ['required', 'boolean'],

            'education_public' => ['required', 'boolean'],
            'education' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->education_public == '1') {
                    if (!$value) {
                        $fail(__('You must choose your education before making it visible.'));
                    } elseif (!in_array($value, EducationType::values())) {
                        $fail(__('Please choose a correct education value'));
                    }
                }
            }],

            'position_public' => ['required', 'boolean'],
            'position' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->position_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your position before maing it visible.'));
                    }
                }
            }],

            
            'x_link_public' => ['required', 'boolean'],
            'x_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->x_link_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your x link before maing it visible.'));
                    }
                }
            }],
            
            'facebook_link_public' => ['required', 'boolean'],
            'facebook_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->facebook_link_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your facebook link before maing it visible.'));
                    }
                }
            }],
            
            'instagram_link_public' => ['required', 'boolean'],
            'instagram_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->instagram_link_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your instagram link before maing it visible.'));
                    }
                }
            }],
            
            'linkedin_link_public' => ['required', 'boolean'],
            'linkedin_link' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->linkedin_link_public == '1') {
                    if (!$value) {
                        $fail(__('You must enter your linkedin link before maing it visible.'));
                    }
                }
            }],

            'type' => ['required', Rule::in(UserType::USER->value, UserType::WRITER->value)],

            'admin' => ['required', 'boolean'],
            'role' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->admin == '1') {
                    if (!$value) {
                        $fail(__('You must enter the user role to make him as admin.'));
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

        $user->update($data);

        $role=ModelsRole::find($request->role);

        $user->syncRoles([$role->name]);

        return response()->json([
            'message' => __('response.profile-updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Storage::disk('public')->exists($user->image ?? ''))
        {
            Storage::disk('public')->delete($user->image ?? '');
        }
        $user->delete();
    }
}
