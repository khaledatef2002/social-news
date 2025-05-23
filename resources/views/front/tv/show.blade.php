@extends('front.layouts.main')

@section('title', $article->title . ' - ' . config('app.name'))

@section('head-additional')

    <meta name="description" content="{{ $article->title }}">

    <meta property="og:title" content="{{ $article->title }} - {{ config('app.name') }}">
    <meta property="og:description" content="{{ $article->title }}">
    <meta property="og:image" content="{{ asset($article->source) }}">
    <meta property="og:url" content="{{ route('front.articles.show', $article) }}">    
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    <meta name="twitter:card" content="{{ asset($article->source) }}">
    <meta name="twitter:title" content="{{ $article->title }} - {{ config('app.name') }}">    
    <meta name="twitter:description" content="{{ $article->title }}">
    <meta name="twitter:image" content="{{ asset($article->source) }}">
    
@endsection

@section('content')
    @if (isset($ad))
        <div class="ad mb-3 mx-auto">
            <a href="{{ $ad->redirect_link }}" target="_blank">
                <img src="{{ asset($ad->cover) }}" title="{{  $ad->title }}" alt="{{  $ad->title }}">
            </a>
        </div>
    @endif
    <main class="tv_articles py-3 flex-fill d-flex justify-content-center">
        <x-tv-article-list-item :tvArticle="$article" />
    </main>
@endsection