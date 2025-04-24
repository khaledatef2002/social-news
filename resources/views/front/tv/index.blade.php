@extends('front.layouts.main')

@section('content')
    <div class="home-wraper flex-fill d-flex justify-content-between py-4">
        <aside></aside>
        <main class="tv_articles col-12 d-flex flex-wrap justify-content-center" data-article-type="tv">
            <x-tv-article-list :tvArticles="$first_tv_articles" />
            <div class="getingTvArticlesLoader justify-content-center w-100">
                <span class="loader"></span>
            </div>
        </main>
        <aside></aside>
    </div>
@endsection

@section('js-after')
    <script>
        const lang = document.querySelector('html').getAttribute('lang')
        let LastTvArticleId = {{ $first_tv_articles->last()?->id | null }}
        const Type = "summary"
    </script>
@endsection