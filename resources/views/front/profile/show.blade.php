@extends('front.layouts.main')

@section('content')
    <div class="profile-wraper flex-fill col-md-8 mx-auto d-flex flex-wrap flex-column gap-4 py-4">
        <div class="card border-0 shadow-sm col-12 align-self-start">
            <div class="card-body d-flex align-items-center justify-content-between">
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
                        <a href="pages-profile-settings.html" class="btn btn-outline-success">
                            <i class="fas fa-edit"></i>
                            تعديل الملف الشخصي
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="d-flex flex-wrap col-12 align-self-start">
            <div class="col-md-4 pe-1 position-sticky top-0">
                <div class="card border-0 shadow-sm personal-info-card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0 text-center fw-bold fs-5 py-1">البيانات الشخصية</h3>
                    </div>
                    <div class="card-body px-0">
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
                    </div>
                </div>
            </div>
            <div class="col-md-8 ps-1">
                <p class="fw-bold text-center fs-5">لا يوجد اي مقالات</p>
            </div>
        </div>
    </div>
@endsection

@section('js-after')
    {{-- <script>
        const lang = document.querySelector('html').getAttribute('lang')
        let LastArticleId = {{ $first_articles->last()?->id | null }}
        const Type = "saved"
    </script> --}}
@endsection