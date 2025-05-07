@extends('front.layouts.main')

@section('content')
<div class="my-5 flex-fill d-flex align-items-center">
    <div class="container">
        <div class="card mx-auto border-0 shadow col-xl-5 col-lg-5 col-md-8 col-11">
            <div class="card-body">
                <p class="fw-bold text-center fs-5">@lang('front.welcome')</p>
                <form id="register-form">
                    <div class="d-flex gap-2">
                        <div class="mb-3 flex-fill">
                            <label for="first_name" class="mb-1">@lang('front.first-name')</label>
                            <input id="first_name" class="form-control" type="text" name="first_name" placeholder="@lang('front.first-name')">
                        </div>
                        <div class="mb-3 flex-fill">
                            <label for="last-name" class="mb-1">@lang('front.last-name')</label>
                            <input id="last_name" class="form-control" type="text" name="last_name" placeholder="@lang('front.last-name')">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="mb-1">@lang('front.email')</label>
                        <input class="form-control" type="email" name="email" placeholder="@lang('front.email')">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="mb-1">@lang('front.phone')</label>
                        <input class="form-control country-selector" type="tel" name="phone" placeholder="@lang('front.phone')">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="mb-1">@lang('front.password')</label>
                        <div>
                            <input class="form-control" type="password" name="password" placeholder="@lang('front.password')">
                            <i class="fas fa-eye password-toggler" role="button"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark px-4 w-100 loader-btn">
                        <p>@lang('front.register')</p>
                        <span class="loader"></span>
                    </button>
                    <p class="my-2">
                        <span>@lang('front.already-have-account')</span>
                        <a href="{{ route('login') }}" class="text-dark">@lang('front.login')</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection