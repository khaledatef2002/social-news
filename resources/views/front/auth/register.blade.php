@extends('front.layouts.main')

@section('content')
<div class="my-5">
    <div class="container">
        <div class="card mx-auto border-0 shadow col-xl-5 col-lg-5 col-md-8 col-11">
            <div class="card-body">
                <p class="fw-bold text-center fs-5">مرحباً بك في مكتبة الاخبار</p>
                <form id="register-form">
                    <div class="d-flex gap-2">
                        <div class="mb-3 flex-fill">
                            <label for="first_name" class="mb-1">الاسم الاول</label>
                            <input id="first_name" class="form-control" type="text" name="first_name" placeholder="الاسم الاول">
                        </div>
                        <div class="mb-3 flex-fill">
                            <label for="last-name" class="mb-1">الاسم الاخير</label>
                            <input id="last_name" class="form-control" type="text" name="last_name" placeholder="الاسم الاخير">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="mb-1">البريد الالكتروني</label>
                        <input class="form-control" type="email" name="email" placeholder="بريد الكتروني">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="mb-1">رقم الهاتف</label>
                        <input class="form-control country-selector" type="tel" name="phone" placeholder="رقم الهاتف">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="mb-1">كلمة المرور</label>
                        <div>
                            <input class="form-control" type="password" name="password" placeholder="كلمة المرور">
                            <i class="fas fa-eye password-toggler" role="button"></i>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-dark px-4 w-100" value="إنشاء الحساب">
                    <p class="my-2">
                        <span>لديك حساب بالفعل؟</span>
                        <a href="{{ route('front.login') }}" class="text-dark">سجل الدخول الان</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection