@if ($tvArticles->count() > 0)
    @foreach ($tvArticles as $tv_article)
        <x-tv-article-list-item :tvArticle="$tv_article" />
    @endforeach
@else
    <x-no-result />
@endif