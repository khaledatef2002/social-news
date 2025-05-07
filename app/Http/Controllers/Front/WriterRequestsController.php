<?php

namespace App\Http\Controllers\Front;

use App\Enum\UserType;
use App\Enum\WriterRequestStatus;
use App\Http\Controllers\Controller;
use App\Models\WriterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WriterRequestsController extends Controller
{
    public function request()
    {
        if(Auth::user()->type == UserType::WRITER)
        {
            return response()->json([
                'errors' => [
                    'already-writer' => [__('front.already-writer')]
                ]
            ], 301);
        }

        if(!Auth::user()->nid)
        {
            return response()->json([
                'errors' => [
                    'empty-nid' => [ "<div class='d-flex flex-column justify-content-center'>" . __('front.empty-nid') . " <a href='". route('front.profile.edit', Auth::user()) ."'>". __('front.edit-profile') ."</a></div>"]
                ]
            ], 301);
        }

        $is_new = Auth::user()->writer_request()->where('status', WriterRequestStatus::PENDING->value)->count() == 0;
    
        if($is_new)
        {
            WriterRequest::create([
                'user_id' => Auth::id(),
                'status' => WriterRequestStatus::PENDING->value
            ]);

            return response()->json([
                'message' => __('front.writer-request-sent'),
                'new_status' => 'new',
                'title' => __('front.cancel-writer-request')
            ]);
        }
        else
        {
            Auth::user()->writer_request()->where('status', WriterRequestStatus::PENDING->value)->delete();

            return response()->json([
                'message' => __('front.writer-request-canceled'),
                'new_status' => 'cancel',
                'title' => __('front.apply-for-writer')
            ]);
        }
    }
}
