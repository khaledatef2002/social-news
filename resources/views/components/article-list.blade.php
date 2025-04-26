@if ($articles->count() > 0)
    @foreach ($articles as $article)
        <x-article-list-item :article="$article" />
    @endforeach
@else
    <x-no-result />
@endif