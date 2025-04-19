@extends('front.layouts.main')

@section('content')
    <div class="home-wraper flex-fill d-flex justify-content-between py-4">
        <aside></aside>
        <main class="articles col-md-4 d-flex flex-column gap-3" data-article-type="summary">
            <x-article-summary-list :articles="$first_articles" />
            <div class="getingArticlesLoader justify-content-center">
                <span class="loader"></span>
            </div>
        </main>
        <aside></aside>
    </div>
@endsection

@section('js-after')
    <script>
        let LastArticleId = {{ $first_articles->last()->id | null }}
        const Type = "summary"
    </script>
@endsection