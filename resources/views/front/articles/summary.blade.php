@extends('front.layouts.main')

@section('content')
    <div class="home-wraper flex-fill d-flex justify-content-between py-4">
        <main class="articles col-12 d-flex flex-wrap justify-content-center" data-article-type="summary">
            <div class="w-100 d-flex justify-content-center mb-3">
                <h3 class="align-self-start mx-auto d-block"><i class="fas fa-cut fs-4"></i> @lang('front.news-summary')</h3>
            </div>
            @if (isset($ad))
                <div class="ad mb-3 mx-auto">
                    <a href="{{ $ad->redirect_link }}" target="_blank">
                        <img src="{{ asset($ad->cover) }}" title="{{  $ad->title }}" alt="{{  $ad->title }}">
                    </a>
                </div>
            @endif
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
        const Type = "summary"
    </script>
@endsection