@extends('front.layouts.main')

@section('content')

<div class="my-5 flex-fill d-flex align-items-center">
    <div class="container">
        <div class="card mx-auto border-0 shadow col-xl-5 col-lg-5 col-md-8 col-11">
            <div class="card-body">
                <p class="fw-bold text-center fs-5">@lang('front.forgot-password')؟</p>
                <form id="forgot-password-form">
                    <div class="mb-3">
                        <label for="email" class="mb-1 text-center d-block">@lang('front.we-will-send-email')</label>
                        <input class="form-control" type="email" name="email" placeholder="@lang('front.email')">
                    </div>
                    <button type="submit" class="btn btn-dark px-4 w-100 loader-btn">
                        <p>@lang('front.send-reset-link')</p>
                        <span class="loader"></span>
                    </button>
                </form>
                <a href="{{ route('login') }}" class="d-block mt-2 text-dark text-center">@lang('front.return-to-login')</a>
            </div>
        </div>
    </div>
</div>

@endsection