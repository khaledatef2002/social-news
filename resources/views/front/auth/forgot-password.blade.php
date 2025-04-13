@extends('front.layouts.main')

@section('content')

<div class="my-5">
    <div class="container">
        <div class="card mx-auto border-0 shadow col-xl-5 col-lg-5 col-md-8 col-11">
            <div class="card-body">
                <p class="fw-bold text-center fs-5">هل نسيت كلمة المرور؟</p>
                <form id="forgot-password-form">
                    <div class="mb-3">
                        <label for="email" class="mb-1 text-center d-block">سنقوم بارسال رابط إعادة تعيين كلمة المرور لك عبر البريد الالكتروني</label>
                        <input class="form-control" type="email" name="email" placeholder="بريد الكتروني">
                    </div>
                    <button type="submit" class="btn btn-dark px-4 w-100 loader-btn">
                        <p>ارسل بريد استعادة كلمة المرور</p>
                        <span class="loader"></span>
                    </button>
                </form>
                <a href="{{ route('login') }}" class="d-block mt-2 text-dark text-center">العودة لتسجيل الدخول</a>
            </div>
        </div>
    </div>
</div>

@endsection