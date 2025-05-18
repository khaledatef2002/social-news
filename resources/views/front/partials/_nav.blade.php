<nav class="navbar navbar-expand-lg bg-body-tertiary py-2 floating-navbar">
    <div class="container-fluid d-flex align-items-center justify-content-between position-relative">
        <div class="z-1">
            <a class="navbar-brand" href="{{ route('front.home') }}">
                <img src="{{ $website_settings->logo }}" alt="Logo" class="logo">
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
                <a class="btn btn-dark px-4 me-2" href="{{ route('register') }}">@lang('front.register')</a>
                <a class="btn btn-outline-dark px-4" href="{{ route('login') }}">@lang('front.login')</a>
            </div>
        @endif
        <ul class="navbar-nav main-icons gap-md-5 gap-4 position-absolute d-flex flex-row justify-content-center w-100 start-0">
            @if(Auth::user()?->can_write_article())
                <li class="nav-item">
                    <a class="nav-link px-2 d-block {{ Route::is('front.articles.create') ? 'active' : '' }}" 
                        aria-current="page" 
                        href="{{ route('front.articles.create') }}"
                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                        data-bs-title="@lang('front.create-article')">
                        <i class="fas fa-plus-square fs-2"></i>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link px-2 d-block {{ Route::is('front.articles-summary.index') ? 'active' : '' }}" 
                    aria-current="page" 
                    href="{{ route('front.articles-summary.index') }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="@lang('front.news-summary')">
                    <i class="fas fa-cut fs-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 d-block {{ Route::is('front.home') ? 'active' : '' }}" 
                    aria-current="page" href="{{ route('front.home') }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="@lang('front.news')">
                    <i class="fas fa-newspaper fs-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 d-block {{ Route::is('front.tv-articles.index') ? 'active' : '' }}" aria-current="page" 
                    href="{{ route('front.tv-articles.index') }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="@lang('front.news-tv')">
                    <i class="fas fa-tv fs-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 d-block {{ Route::is('front.writers.index') ? 'active' : '' }}" aria-current="page" 
                    href="{{ route('front.writers.index') }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="@lang('front.writers')">
                    <i class="fas fa-pen-fancy fs-2"></i>
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
                    <ul class="dropdown-menu" style="">
                        @if (Auth::user()->admin)
                            <li><a class="dropdown-item" href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> @lang('front.dashboard')</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('front.profile.show', Auth::user()) }}"><i class="fas fa-user-alt"></i> @lang('front.profile')</a></li>
                        <li><a class="dropdown-item" href="{{ route('front.saved-articles.index') }}"><i class="fas fa-bookmark"></i> @lang('front.saved-news')</a></li>
                        @if(Auth::user()->type != \App\Enum\UserType::WRITER->value && Auth::user()->writer_request()->where('status', \App\Enum\WriterRequestStatus::PENDING->value)->count() == 0)
                            <li><button class="dropdown-item writer_request"><i class="fas fa-pencil-alt"></i> @lang('front.apply-for-writer')</button></li>
                        @elseif(Auth::user()->type != \App\Enum\UserType::WRITER->value && Auth::user()->writer_request()->where('status', \App\Enum\WriterRequestStatus::PENDING->value)->count() == 1)
                            <li><button class="dropdown-item text-danger writer_request"><i class="fas fa-pencil-alt"></i> @lang('front.cancel-writer-request')</button></li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> @lang('front.logout')</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a class="btn btn-dark px-4 me-2" href="{{ route('register') }}">@lang('front.register')</a>
                <a class="btn btn-outline-dark px-4" href="{{ route('login') }}">@lang('front.login')</a>
            @endauth
        </div>

        @auth
            <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarSupportedContent" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-body p-0">
                    <ul class="m-0 p-0 d-flex flex-column">
                        @if (Auth::user()->admin)
                            <li><a class="dropdown-item" href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> @lang('front.dashboard')</a></li>
                        @endif
                        <li><a class="dropdown-item py-2 px-2" href="{{ route('front.profile.show', Auth::user()) }}"><i class="fas fa-user-alt"></i> @lang('front.profile')</a></li>
                        <li><a class="dropdown-item py-2 px-2" href="{{ route('front.saved-articles.index') }}"><i class="fas fa-bookmark"></i> @lang('front.saved-news')</a></li>
                        @if(Auth::user()->type != \App\Enum\UserType::WRITER->value && Auth::user()->writer_request()->where('status', \App\Enum\WriterRequestStatus::PENDING->value)->count() == 0)
                            <li><button class="dropdown-item writer_request"><i class="fas fa-pencil-alt"></i> @lang('front.apply-for-writer')</button></li>
                        @elseif(Auth::user()->type != \App\Enum\UserType::WRITER->value && Auth::user()->writer_request()->where('status', \App\Enum\WriterRequestStatus::PENDING->value)->count() == 1)
                            <li><button class="dropdown-item text-danger writer_request"><i class="fas fa-pencil-alt"></i> @lang('front.cancel-writer-request')</button></li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 px-2" href="#"><i class="fas fa-sign-out-alt"></i> @lang('front.logout')</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="offcanvas-footer">
                    <button class="w-100 btn btn-dark rounded-0" type="button" data-bs-dismiss="offcanvas" >@lang('front.close')</button>
                </div>
            </div>
        @endauth
    </div>
    <div id="top-floating-icons" class="me-2 end-0 d-flex align-items-center gap-2">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if ($localeCode != LaravelLocalization::getCurrentLocale())
                <a  href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" 
                    class="shadow-sm notify-item language ms-3" 
                    data-lang="{{ $localeCode }}" 
                    title="{{ $properties['native'] }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-title="@lang('front.change-language')">
                    <img src="{{ asset('front/images/' . $localeCode . '.svg') }}" alt="user-image" class="rounded" height="22">
                </a>
            @endif
        @endforeach
        <i  id="dark_mood_button" 
            class="far fa-moon fs-4 shadow-sm" 
            role="button"
            data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-title="@lang('front.dark-mode-switch')"></i>
    </div>
</nav>