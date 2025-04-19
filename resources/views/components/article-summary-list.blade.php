@foreach ($articles as $article)
    <x-article-summary-list-item :article="$article" />
@endforeach