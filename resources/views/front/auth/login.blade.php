@extends('front.layouts.main')

@section('content')

<div class="my-5 flex-fill d-flex align-items-center">
    <div class="container">
        <div class="card mx-auto border-0 shadow col-xl-5 col-lg-5 col-md-8 col-11">
            <div class="card-body">
                <p class="fw-bold text-center fs-5">اهلاً بك مجدداً</p>
                <form id="login-form">
                    <div class="mb-3">
                        <label for="email" class="mb-1">البريد الالكتروني</label>
                        <input class="form-control" type="email" name="email" placeholder="بريد الكتروني">
                    </div>
                    <div class="mb-0">
                        <label for="password" class="mb-1">كلمة المرور</label>
                        <div>
                            <input class="form-control" type="password" name="password" placeholder="كلمة المرور">
                            <i class="fas fa-eye password-toggler" role="button"></i>
                        </div>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-dark d-inline-block my-2">هل نسيت كلمة المرور؟</a>
                    <button type="submit" class="btn btn-dark px-4 w-100 loader-btn">
                        <p>تسجيل الدخول الان</p>
                        <span class="loader"></span>
                    </button>
                    <p class="my-2">
                        <span>جديد في مكتبة الاخبار؟</span>
                        <a href="{{ route('register') }}" class="text-dark">انشئ حسابك الان</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection