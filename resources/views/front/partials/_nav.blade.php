<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('front/images/logo.png') }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav gap-2 ms-3 me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">الرئيسية</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        منبثق
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        منبثق
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">الاكثر تقييماً</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">الاكثر مشاهدة</a>
                </li>
            </ul>
            <form class="d-flex align-items-center gap-2" role="search">
                <i class="fa-solid fa-magnifying-glass me-3"></i>
                <a class="btn btn-dark px-4" href="{{ route('front.register') }}">اشتراك</a>
                <a class="btn btn-outline-dark px-4" href="{{ route('front.login') }}">تسجيل الدخول</a>
            </form>
            <div class="dropdown ms-1">
                <button id="lang_open" type="button" class="btn btn-icon btn-topbar rounded-circle">
                    <img id="header-lang-img" src="{{ asset('front/images/' . LaravelLocalization::getCurrentLocale() . '.svg') }}" alt="Header Language" height="20" class="rounded">
                </button>
                <div class="lang-menu">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if ($localeCode != LaravelLocalization::getCurrentLocale())
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" class="dropdown-item notify-item language py-2" data-lang="{{ $localeCode }}" title="{{ $properties['native'] }}">
                                <img src="{{ asset('front/images/' . $localeCode . '.svg') }}" alt="user-image" class="me-2 rounded" height="18">
                                <span class="align-middle">{{ $properties['native'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <i class="far fa-moon fs-4 ms-2" role="button"></i>
        </div>
    </div>
</nav>