<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\SystemSettings;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class WebsiteSettingsController extends Controller implements HasMiddleware
{
    public static function Middleware()
    {
        return [
            new Middleware('can:website_settings_show', only: ['index']),
            new Middleware('can:website_settings_edit', only: ['change_logo', 'change_banner', 'update']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.website_settings.index');
    }

    public function change_logo(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg|max:10240']
        ]);

        $image = $request->file('logo');
        $imagePath = 'website-settings/logo/' . uniqid() . '.webp';

        $manager = new ImageManager(new GdDriver());
        $manager->read($image)
                ->scale(height: 60)
                ->encode(new AutoEncoder('webp', quality: 75))
                ->save('storage/' . $imagePath);

        $url = Storage::url($imagePath);
        
        $setting = SystemSettings::find(1);

        if($setting->logo && Storage::disk('public')->exists($setting->logo))
        {
            Storage::disk('public')->delete($setting->logo);
        }

        $setting->logo = $url;

        $setting->save();

        return response()->json([
            'message' => __('response.website-logo-updated'),
        ]);
    }

    public function change_banner(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'image', 'mimes:jpeg,png,jpg|max:10240']
        ]);

        $image = $request->file('banner');
        $imagePath = 'website-settings/banner/' . uniqid() . '.webp';

        $manager = new ImageManager(new GdDriver());
        $manager->read($image)
                ->scale(width: 450)
                ->encode(new AutoEncoder('webp', quality: 75))
                ->save('storage/' . $imagePath);

        $url = Storage::url($imagePath);

        $setting = SystemSettings::find(1);

        if($setting->banner && Storage::disk('public')->exists($setting->banner))
        {
            Storage::disk('public')->delete($setting->banner);
        }

        $setting->banner = $url;

        $setting->save();

        return response()->json([
            'message' => __('response.website-banner-updated'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'min:2'],
            'keywords' => ['required'],
            'description' => ['required']
        ]);

        $setting = SystemSettings::find(1);
        $setting->update($data);

        return response()->json([
            'message' => __('response.website-settings-updated'),
        ]);
    }
}
