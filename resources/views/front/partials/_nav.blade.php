<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div>
            <a class="navbar-brand" href="#">
                <img src="{{ asset('front/images/logo.png') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav gap-5">
                <li class="nav-item">
                    <a class="nav-link px-2 d-block" aria-current="page" href="#">
                        <i class="fas fa-plus-square fs-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 d-block active" aria-current="page" href="#">
                        <i class="fas fa-newspaper fs-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 d-block" aria-current="page" href="#">
                        <i class="fas fa-tv fs-2"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <form class="d-flex align-items-center gap-2" role="search">
                <i class="fa-solid fa-magnifying-glass me-3"></i>
                <a class="btn btn-dark px-4" href="{{ route('front.register') }}">اشتراك</a>
                <a class="btn btn-outline-dark px-4" href="{{ route('front.login') }}">تسجيل الدخول</a>
            </form>
        </div>
    </div>
</nav>