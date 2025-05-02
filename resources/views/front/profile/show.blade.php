@extends('front.layouts.main')

@section('content')
    <div class="profile-wraper flex-fill col-12 mx-auto d-flex flex-wrap flex-column gap-4 py-5 px-3">
        <div class="card border-0 shadow-sm col-12 align-self-start">
            <div class="card-body d-flex flex-wrap gap-3 align-items-center justify-content-between">
                <div class="d-flex gap-2 align-items-center">
                    <div class="user-image-holder" style="width:80px;height:80px;">
                        <img src="{{ $user->display_image }}" />
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">{{ $user->full_name }}</h3>
                        <Span>{{ $user->type }}</Span>
                    </div>
                </div>
                @if (Auth::check() && Auth::id() == $user->id)
                    <div class="flex-shrink-0">
                        <a href="{{ route('front.profile.edit', $user) }}" class="btn btn-outline-success">
                            <i class="fas fa-edit"></i>
                            @lang('front.edit-profile')
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="d-flex flex-md-row flex-column flex-wrap col-12 align-self-start">
            <div class="col-md-4 pe-1 position-sticky top-0">
                <div class="card border-0 shadow-sm personal-info-card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0 text-center fw-bold fs-5 py-1">@lang('front.personal-info')</h3>
                    </div>
                    <div class="card-body px-0">
                        @php
                            $is_personal_info = ($user->education && $user->education_public) ||
                                ($user->position && $user->position_public) ||
                                ($user->phone && $user->phone_public);

                            $is_social_media = ($user->x_link && $user->x_link_public) ||
                                ($user->facebook_link && $user->facebook_link_public) ||
                                ($user->instagram_link && $user->instagram_link_public) ||
                                ($user->linkedin_link && $user->linkedin_link_public) ;
                        @endphp
                        @if ($is_personal_info || $is_social_media)
                            @if ($is_personal_info)
                                <div class="personal-info px-3">
                                    @if ($user->education && $user->education_public)
                                        <p>
                                            <i class="fas fa-graduation-cap"></i>
                                            {{ $user->education }}
                                        </p>
                                    @endif
                                    @if ($user->position && $user->position_public)
                                        <p>
                                            <i class="fas fa-briefcase"></i>
                                            {{ $user->position }}
                                        </p>
                                    @endif
                                    @if ($user->phone && $user->phone_public)
                                        <p>
                                            <i class="fas fa-phone"></i>
                                            {{ $user->phone }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                            @if ($is_social_media)
                                <div class="social-media d-flex justify-content-center align-items-center gap-4 fs-5">
                                    @if ($user->x_link && $user->x_link_public)
                                        <a href="{{ $user->x_link }}" target="_blank" class="text-dark"><i class="fab fa-x-twitter"></i></a>
                                    @endif
                                    @if ($user->facebook_link && $user->facebook_link_public)
                                        <a href="{{ $user->facebook_link }}" target="_blank" class="text-dark"><i class="fab fa-facebook"></i></a>
                                    @endif
                                    @if ($user->instagram_link && $user->instagram_link_public)
                                        <a href="{{ $user->instagram_link }}" target="_blank" class="text-dark"><i class="fab fa-instagram"></i></a>
                                    @endif
                                    @if ($user->linkedin_link && $user->linkedin_link_public)
                                        <a href="{{ $user->linkedin_link }}" target="_blank" class="text-dark"><i class="fab fa-linkedin"></i></a>
                                    @endif
                                </div>
                            @endif
                        @else
                            <p class="text-center fs-5 mb-0">@lang('front.no-personal-info')</p>
                        @endif
                    </div>
                </div>
            </div>
            <main class="articles col-md-8 col-12 ps-md-2 d-flex mt-md-0 mt-3 justify-content-between">
                <div class="row m-0 w-100">
                    <x-profile-article-list :articles="$first_articles" />
                    <div class="getingArticlesLoader justify-content-center w-100">
                        <span class="loader"></span>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

@section('js-after')
    <script>
        const lang = document.querySelector('html').getAttribute('lang')
        let LastArticleId = {{ $first_articles->last()?->id | null }}
        const Type = "profile"
        const USER_ID = {{ $user->id }}
    </script>
@endsection