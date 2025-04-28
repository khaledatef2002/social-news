@extends('front.layouts.main')

@section('content')
    <div class="home-wraper flex-fill d-flex justify-content-between py-4">
        <main class="articles col-12 d-flex flex-wrap justify-content-center">
            <div class="w-100 d-flex justify-content-center mb-3">
                <h3 class="align-self-start mx-auto d-block"><i class="far fa-bookmark fs-4"></i> المقالات المحفوظة</h3>
            </div>
            <div class="row w-100">
                <x-article-summary-list :articles="$first_articles" />
                <div class="getingArticlesLoader justify-content-center w-100">
                    <span class="loader"></span>
                </div>
            </div>
        </main>
    </div>
@endsection

@section('js-after')
    <script>
        const lang = document.querySelector('html').getAttribute('lang')
        let LastArticleId = {{ $first_articles->last()?->id | null }}
        const Type = "saved"
    </script>
@endsection