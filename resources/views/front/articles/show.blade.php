@extends('front.layouts.main')

@section('title', $article->title . ' - ' . $website_settings->title)

@section('head-additional')

    <meta name="description" content="{{ $article->short }}">

    <meta property="og:title" content="{{ $article->title }} - {{ config('app.name') }}">
    <meta property="og:description" content="{{ $article->short }}">
    <meta property="og:image" content="{{ asset($article->cover) }}">
    <meta property="og:url" content="{{ route('front.articles.show', $article) }}">    
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    <meta name="twitter:card" content="{{ asset($article->cover) }}">
    <meta name="twitter:title" content="{{ $article->title }} - {{ config('app.name') }}">    
    <meta name="twitter:description" content="{{ $article->short }}">
    <meta name="twitter:image" content="{{ asset($article->cover) }}">
    
@endsection

@section('content')
<main class="py-3 col-12 d-flex flex-column" data-article-type="summary">
    <article class="card col-lg-7 col-md-8 col-12 mx-auto rounded border-0 shadow-sm" data-article-id="{{ $article->id }}">
        <div class="py-2 px-2 text-start">
            <div class="meta-content d-flex flex-column mb-2 fw-bold">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center gap-2">
                        <div class="user-image-holder">
                            <img src="{{ $article->user->display_image }}">
                        </div>
                        <div class="meta-data d-flex flex-column">
                            <a href="{{ route('front.profile.show', $article->user) }}" class="text-dark text-decoration-noe"><span class="user fs-4">{{ $article->user->full_name }}</span></a>
                            <div class="meta-date-category d-flex align-items-center gap-3">
                                <span class="date fs-7 fw-normal"><i class="far fa-clock fs-"></i> {{ $article->created_at->locale(app()->getLocale())->diffForHumans() }}</span>
                                <span class="category fs-7 fw-normal"><i class="fas fa-list-ul"></i> {{ $article->category->title }}</span>
                            </div>
                        </div>
                    </span>
                    @if (Auth::id() == $article->user->id)
                    <div class="dropdown article_action_list">
                        <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end2">
                            <li class="user_save_article_action dropdown-item d-flex gap-2 align-items-center {{ Auth::user()?->saved_article($article->id) ? 'saved' : '' }}" role="button"><i class="{{ Auth::user()?->saved_article($article->id) ? 'fas' : 'far' }} fa-bookmark"></i> {{ Auth::user()?->saved_article($article->id) ? __('front.remove-from-saved') : __('front.save-to-saved') }}</li>
                                <a href="{{ route('front.articles.edit', $article) }}" class="text-decoration-none"><li class="dropdown-item d-flex gap-2 align-items-center" role="button"><i class="fas fa-pen"></i> تعديل الخبر</li></a>
                            <li class="dropdown-item d-flex gap-2 align-items-center remove_article" role="button"><i class="fas fa-trash-alt"></i> @lang('front.remove')</li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            <h3 class="fs-5 fw-bold pt-2"><a class="text-decoration-none text-dark">{{ $article->title }}</a></h3>
        </div>
        <a>
            <div class="image-holder image-holder-auto-height">
                <img src="{{ $article->cover }}" />
            </div>
        </a>
        <div class="article-content mt-3 px-2">
            {!! $article->content !!}
        </div>
        @if ($article->source)
            <div class="article-source mb-1 d-flex gap-1 px-2">
                <p class="fw-bold mb-0">المصدر: </p> <a href="{{ $article->source }}" class="text-dark">{{ $article->source }}</a>
            </div>
        @endif
        <div class="reacts-container">
            <div class="reacts_count px-2 py-1 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    @auth
                        <button class="heart_action_button bg-white loader-btn {{ $article->isAuthReacted() ? 'reacted' : '' }} fw-bold fs-6 d-flex justify-content-center align-items-center">
                            <p>
                                <i class="{{ $article->isAuthReacted() ? 'fas' : 'far' }} fa-heart"></i>
                            </p>
                            <span class="loader"></span>
                        </button>
                    @else
                        <i class="fas fa-heart text-danger"></i>
                    @endauth
                    <span class="count fw-bold">{{ $article->reacts()->count() > 0 ? $article->reacts()->count() : '' }}</span>
                </div>
                <ul class="p-0 m-0 d-flex gap-3 pe-1">
                    <a  href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.articles.show', $article) }}" 
                        target="_blank"
                        class="text-decoration-none text-primary"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="@lang('front.share') @lang('front.facebook')">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a  href="https://twitter.com/intent/tweet?url={{ route('front.articles.show', $article) }}&text=Check%20this%20out!" 
                        target="_blank"
                        class="text-decoration-none text-dark"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="@lang('front.share') @lang('front.x')">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    <a  href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('front.articles.show', $article) }}&title=Your%20Title" 
                        target="_blank"
                        class="text-decoration-none text-primary"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="@lang('front.share') @lang('front.linkedin')">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a  href="https://api.whatsapp.com/send?text={{ route('front.articles.show', $article) }}" 
                        target="_blank"
                        class="text-decoration-none text-success"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="@lang('front.share') @lang('front.whatsapp')">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </ul>
            </div>
        </div>
    </article>
</main>
@endsection

@section('js-after')
<script>
    // get bage direction from html tag
    const direction = document.querySelector('html').getAttribute('dir')
</script>

@endsection