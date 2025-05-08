<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset($website_settings->logo) }}" alt="@lang('dashboard.logo_alt')" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset($website_settings->logo) }}" alt="@lang('dashboard.logo_alt')" height="17">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset($website_settings->logo) }}" alt="@lang('dashboard.logo_alt')" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset($website_settings->logo) }}" alt="@lang('dashboard.logo_alt')" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown ms-1 topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img id="header-lang-img" src="{{ asset('back') }}/images/flags/{{ LaravelLocalization::getCurrentLocale() }}.svg" alt="@lang('dashboard.language_icon')" height="20" class="rounded">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        @foreach (LaravelLocalization::getSupportedLocales() as $key => $lang)
                            @if ($key != LaravelLocalization::getCurrentLocale())
                                <a href="{{ LaravelLocalization::getLocalizedURL($key) }}" class="dropdown-item notify-item language py-2" data-lang="{{ $key }}" title="{{ $lang['name'] }}">
                                    <img src="{{ asset('back') }}/images/flags/{{ $key }}.svg" alt="@lang('dashboard.language_icon')" class="me-2 rounded" height="18">
                                    <span class="align-middle">{{ $lang['name'] }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                        <span class="visually-hidden">@lang('dashboard.toggle_fullscreen')</span>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                        <span class="visually-hidden">@lang('dashboard.toggle_dark_mode')</span>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">3<span class="visually-hidden">@lang('dashboard.unread_notifications')</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white">@lang('dashboard.notifications')</h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge bg-light-subtle text-body fs-13">@lang('dashboard.new_notifications', ['count' => 4])</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Rest of notification dropdown content -->
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ Auth::user()->display_image }}" alt="@lang('dashboard.user_avatar')">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->full_name }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ Auth::user()->getRoleNames()[0] }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">@lang('dashboard.welcome_user', ['name' => Auth::user()->first_name])</h6>
                        <a class="dropdown-item" href="pages-profile">
                            <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">@lang('dashboard.profile')</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">@lang('dashboard.logout')</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>