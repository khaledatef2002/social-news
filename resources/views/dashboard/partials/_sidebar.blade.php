<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box py-2">
        <!-- Dark Logo-->
        <a href="{{ route('dashboard.index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset($website_settings->logo) }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset($website_settings->logo) }}" alt="" height="70">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('dashboard.index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset($website_settings->logo) }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset($website_settings->logo) }}" alt="" height="70">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::currentRouteName() ==  'dashboard.index' ? 'active' : ''}}" href="{{ route('dashboard.index') }}" role="button">
                        <i class="ri-home-3-fill"></i> <span>@lang('dashboard.home')</span>
                    </a>
                </li> <!-- End Home Menu-->
                @if (Auth::user()->hasPermissionTo('articles_show'))
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::currentRouteName() ==  'dashboard.articles-category.index' ? 'active' : ''}}" href="#articlesMenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUI">
                            <i class="ri-article-line"></i> <span>@lang('dashboard.articles')</span>
                        </a>
                        <div class="collapse menu-dropdown mega-dropdown-menu" id="articlesMenu">
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('dashboard.articles-categories.index') }}" class="nav-link">@lang('dashboard.categories')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('dashboard.articles.index') }}" class="nav-link">@lang('dashboard.all-articles')</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
                @if (Auth::user ()->hasPermissionTo('tv_articles_show'))         
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::currentRouteName() ==  'dashboard.tv-articles-category.index' ? 'active' : ''}}" href="#tvArticlesMenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUI">
                            <i class="ri-tv-line"></i> <span>@lang('dashboard.tv-articles')</span>
                        </a>
                        <div class="collapse menu-dropdown mega-dropdown-menu" id="tvArticlesMenu">
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('dashboard.tv-articles-categories.index') }}" class="nav-link">@lang('dashboard.categories')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('dashboard.tv-articles.index') }}" class="nav-link">@lang('dashboard.all-tv-articles')</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->hasPermissionTo('writer_requests_show'))
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::currentRouteName() ==  'dashboard.writer-request.index' ? 'active' : ''}}" href="{{ route('dashboard.writer-request.index') }}" role="button">
                            <i class="ri-pencil-line"></i> <span>@lang('dashboard.writer-requests')</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasPermissionTo('users_show'))
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::currentRouteName() ==  'dashboard.users.index' ? 'active' : ''}}" href="{{ route('dashboard.users.index') }}" role="button">
                            <i class="ri-user-fill"></i> <span>@lang('dashboard.users')</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasPermissionTo('roles_show'))
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Route::currentRouteName() ==  'dashboard.roles.index' ? 'active' : ''}}" href="{{ route('dashboard.roles.index') }}" role="button">
                            <i class="ri-key-2-fill"></i> <span>@lang('dashboard.roles')</span>
                        </a>
                    </li> <!-- End Website Settings Menu -->
                @endif
                @if (Auth::user()->hasPermissionTo('website_settings_show'))
                    <li class="nav-item">               
                        <a class="nav-link menu-link {{ Route::currentRouteName() ==  'dashboard.website_setting.index' ? 'active' : ''}}" href="{{ route('dashboard.website_setting.index') }}" role="button">
                            <i class="ri-tools-fill"></i> <span>@lang('dashboard.website-settings')</span>
                        </a>
                    </li> <!-- End Website Settings Menu -->
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>