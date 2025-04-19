<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div>
            <a class="navbar-brand" href="{{ route('front.home') }}">
                <img src="{{ asset('front/images/logo.png') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav gap-5">
                @auth
                    <li class="nav-item">
                        <a class="nav-link px-2 d-block {{ Route::is('front.articles.create') ? 'active' : '' }}" 
                            aria-current="page" 
                            href="{{ route('front.articles.create') }}"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            data-bs-title="اضافة مقالة">
                            <i class="fas fa-plus-square fs-2"></i>
                        </a>
                    </li>
                @endauth
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
                    <a class="nav-link px-2 d-block" aria-current="page" 
                        href="#"
                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                        data-bs-title="تلفاز الاخبار">
                        <i class="fas fa-tv fs-2"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                <form class="d-flex align-items-center gap-2" role="search">
                    <i class="fa-solid fa-magnifying-glass me-3"></i>
                </form>
                @auth
                    <div class="dropdown">
                        <div class="profile-image-menu-container" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                            <img src="{{ Auth::user()->display_image }}" class="profile-image-menu" alt="Profile Image">
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end" style="">
                            <li><a class="dropdown-item" href="#">الملف الشخصي</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" href="#">تسجيل الخروج</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="btn btn-dark px-4 me-2" href="{{ route('register') }}">اشتراك</a>
                    <a class="btn btn-outline-dark px-4" href="{{ route('login') }}">تسجيل الدخول</a>
                @endauth
        </div>
    </div>
</nav>