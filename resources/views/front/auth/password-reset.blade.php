@extends('front.layouts.main')

@section('content')

<div class="my-5">
    <div class="container">
        <div class="card mx-auto border-0 shadow col-xl-5 col-lg-5 col-md-8 col-11">
            <div class="card-body">
                <p class="fw-bold text-center fs-5">@lang('front.reset-password')</p>
                <form id="password-reset-form">
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="mb-3">
                        <label for="email" class="mb-1 d-block">@lang('front.email')</label>
                        <input class="form-control" type="email" name="email" placeholder="@lang('front.email')">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="mb-1 d-block">@lang('front.new-password')</label>
                        <input class="form-control" type="password" name="password" placeholder="@lang('front.new-password')">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="mb-1 d-block">@lang('front.confirm-password')</label>
                        <input class="form-control" type="password" name="password_confirmation" placeholder="@lang('front.confirm-password')">
                    </div>
                    <button type="submit" class="btn btn-dark px-4 w-100 loader-btn">
                        <p>@lang('front.reset')</p>
                        <span class="loader"></span>
                    </button>
                </form>
                <a href="{{ route('login') }}" class="d-block mt-2 text-dark text-center">@lang('front.return-to-login')</a>
            </div>
        </div>
    </div>
</div>

@endsection