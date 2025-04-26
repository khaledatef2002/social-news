<nav class="navbar navbar-expand-lg bg-body-tertiary py-2 floating-navbar">
    <div class="container-fluid d-flex align-items-center justify-content-between position-relative">
        <div class="z-1">
            <a class="navbar-brand" href="{{ route('front.home') }}">
                <img src="{{ asset('front/images/logo.png') }}">
            </a>
        </div>
        @if (Auth::check())
            <button class="navbar-toggler z-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <div class="profile-image-menu-container" aria-expanded="false" role="button">
                    <img src="{{ Auth::user()->display_image }}" class="profile-image-menu" alt="Profile Image">
                </div>
            </button>
        @else
            <div class="navbar-toggler">
                <a class="btn btn-dark px-4 me-2" href="{{ route('register') }}">اشتراك</a>
                <a class="btn btn-outline-dark px-4" href="{{ route('login') }}">تسجيل الدخول</a>
            </div>
        @endif
        <ul class="navbar-nav main-icons gap-md-5 gap-4 position-absolute d-flex flex-row justify-content-center w-100 start-0">
            @if(Auth::user()?->can_write_article())
                <li class="nav-item">
                    <a class="nav-link px-2 d-block {{ Route::is('front.articles.create') ? 'active' : '' }}" 
                        aria-current="page" 
                        href="{{ route('front.articles.create') }}"
                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                        data-bs-title="اضافة مقالة">
                        <i class="fas fa-plus-square fs-2"></i>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link px-2 d-block {{ Route::is('front.articles-summary.index') ? 'active' : '' }}" 
                    aria-current="page" 
                    href="{{ route('front.articles-summary.index') }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="مختصر المقالات">
                    <i class="fas fa-cut fs-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 d-block {{ Route::is('front.home') ? 'active' : '' }}" 
                    aria-current="page" href="{{ route('front.home') }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="المقالات">
                    <i class="fas fa-newspaper fs-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 d-block {{ Route::is('front.tv-articles.index') ? 'active' : '' }}" aria-current="page" 
                    href="{{ route('front.tv-articles.index') }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="تلفاز الاخبار">
                    <i class="fas fa-tv fs-2"></i>
                </a>
            </li>
        </ul>
        <div class="collapse navbar-collapse flex-grow-0 z-1" >
            {{-- <form class="d-flex align-items-center gap-2" role="search">
                <i class="fa-solid fa-magnifying-glass me-3"></i>
            </form> --}}
            @auth
                <div class="dropdown">
                    <div class="profile-image-menu-container" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                        <img src="{{ Auth::user()->display_image }}" class="profile-image-menu" alt="Profile Image">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end" style="">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-alt"></i> الملف الشخصي</a></li>
                        <li><a class="dropdown-item" href="{{ route('front.saved-articles.index') }}"><i class="fas fa-bookmark"></i> المقالات المحفوظة</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a class="btn btn-dark px-4 me-2" href="{{ route('register') }}">اشتراك</a>
                <a class="btn btn-outline-dark px-4" href="{{ route('login') }}">تسجيل الدخول</a>
            @endauth
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarSupportedContent" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-body p-0">
                <ul class="m-0 p-0 d-flex flex-column">
                    <li><a class="dropdown-item py-2 px-2" href="#"><i class="fas fa-user-alt"></i> الملف الشخصي</a></li>
                    <li><a class="dropdown-item py-2 px-2" href="{{ route('front.saved-articles.index') }}"><i class="fas fa-bookmark"></i> المقالات المحفوظة</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 px-2" href="#"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="offcanvas-footer">
                <button class="w-100 btn btn-dark rounded-0" type="button" data-bs-dismiss="offcanvas" >إغلاق</button>
            </div>
        </div>
    </div>
    <div id="top-floating-icons" class="me-2 end-0 d-flex align-items-center gap-2">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if ($localeCode != LaravelLocalization::getCurrentLocale())
                <a  href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" 
                    class="shadow-sm notify-item language ms-3" 
                    data-lang="{{ $localeCode }}" 
                    title="{{ $properties['native'] }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="تغيير اللغة">
                    <img src="{{ asset('front/images/' . $localeCode . '.svg') }}" alt="user-image" class="rounded" height="22">
                </a>
            @endif
        @endforeach
        <i  id="dark_mood_button" 
            class="far fa-moon fs-4 shadow-sm" 
            role="button"
            data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-title="التبديل بين الوضوح والظلام"></i>
    </div>
</nav>