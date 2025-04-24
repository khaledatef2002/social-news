@extends('front.layouts.main')

@section('content')
    <div class="home-wraper flex-fill d-flex justify-content-between py-4">
        <aside></aside>
        <main class="articles col-12 d-flex flex-wrap justify-content-center" data-article-type="summary">
            <x-article-summary-list :articles="$first_articles" />
            <div class="getingArticlesLoader justify-content-center w-100">
                <span class="loader"></span>
            </div>
        </main>
        <aside></aside>
    </div>
@endsection

@section('js-after')
    <script>
        const lang = document.querySelector('html').getAttribute('lang')
        let LastArticleId = {{ $first_articles->last()?->id | null }}
        const Type = "summary"
    </script>
@endsection