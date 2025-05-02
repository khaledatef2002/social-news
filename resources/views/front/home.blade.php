@extends('front.layouts.main')

@section('content')
    <div class="home-wraper flex-fill d-flex justify-content-between py-4">
        <aside></aside>
        <main class="articles col-12 d-flex flex-wrap justify-content-center">
            <div class="w-100 d-flex justify-content-center mb-3">
                <h3 class="align-self-start mx-auto d-block"><i class="far fa-newspaper fs-4"></i> @lang('front.news')</h3>
            </div>
            <div class="row w-100">
                <x-article-list :articles="$first_articles" />
                <div class="getingArticlesLoader justify-content-center w-100">
                    <span class="loader"></span>
                </div>
            </div>
        </main>
        <aside></aside>
    </div>
@endsection

@section('js-after')
    <script>
        const lang = document.querySelector('html').getAttribute('lang')
        let LastArticleId = {{ $first_articles->last()?->id | null }}
        const Type = "article"
    </script>
@endsection