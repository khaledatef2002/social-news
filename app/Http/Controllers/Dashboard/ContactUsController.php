<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('can:contact_us_show', only: ['index', 'show']),
            new Middleware('can:contact_us_delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $contact_us = ContactUs::get();
            return DataTables::of($contact_us)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                "<button class='remove_button show_contact' data-id='".$row['id']."'><i class='ri-eye-line fs-4' type='submit'></i></button>"
                .  
                (Auth::user()->hasPermissionTo('contact_us_delete') ?
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
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('dashboard.contact-us.index');
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
    public function show(ContactUs $contact_u)
    {
        return response()->json([
            'message' => __('response.contact-us-found'),
            'contact_us' => $contact_u
        ]);
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
    public function destroy(ContactUs $contact_u)
    {
        $contact_u->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
