@extends('front.layouts.main')

@section('content')
    <div class="home-wraper flex-fill d-flex justify-content-between py-4">
        <main class="tv_articles col-12 d-flex flex-wrap justify-content-center" data-article-type="tv">
            <div class="w-100 d-flex justify-content-center mb-3">
                <h3 class="align-self-start mx-auto d-block"><i class="fas fa-tv fs-4"></i> @lang('front.news-tv')</h3>
            </div>
            <x-tv-article-list :tvArticles="$first_tv_articles" />
            <div class="getingTvArticlesLoader justify-content-center w-100">
                <span class="loader"></span>
            </div>
        </main>
    </div>
@endsection

@section('js-after')
    <script>
        const lang = document.querySelector('html').getAttribute('lang')
        let LastTvArticleId = {{ $first_tv_articles->last()?->id | null }}
        const Type = "summary"
    </script>
@endsection