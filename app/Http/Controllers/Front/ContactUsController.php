<?php

namespace App\Http\Controllers\Front;

use App\Enum\AdPages;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Services\AdService;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdService $ad_service)
    {
        $ad = $ad_service->getByPage(AdPages::Contact->value);
        return view('front.contact-us', compact('ad'));
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
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],  
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'min:5'],
        ]);

        ContactUs::create($data);

        return response()->json([
            'status' => 'success',
            'message' => __('response.send-contact-us-success'),
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
