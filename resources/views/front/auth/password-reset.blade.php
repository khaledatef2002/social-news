@extends('front.layouts.main')

@section('content')

<div class="my-5">
    <div class="container">
        <div class="card mx-auto border-0 shadow col-xl-5 col-lg-5 col-md-8 col-11">
            <div class="card-body">
                <p class="fw-bold text-center fs-5">إعادة تعيين كلمة المرور</p>
                <form id="password-reset-form">
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="mb-3">
                        <label for="email" class="mb-1 d-block">البريد الالكتروني</label>
                        <input class="form-control" type="email" name="email" placeholder="بريد الكتروني">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="mb-1 d-block">كلمة المرور الجديدة</label>
                        <input class="form-control" type="password" name="password" placeholder="كلمة المرور">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="mb-1 d-block">أعد كتابة كلمة المرور</label>
                        <input class="form-control" type="password" name="password_confirmation" placeholder="كلمة المرور">
                    </div>
                    <button type="submit" class="btn btn-dark px-4 w-100 loader-btn">
                        <p>تعيين كلمة المرور</p>
                        <span class="loader"></span>
                    </button>
                </form>
                <a href="{{ route('login') }}" class="d-block mt-2 text-dark text-center">العودة لتسجيل الدخول</a>
            </div>
        </div>
    </div>
</div>

@endsection