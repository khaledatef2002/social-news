@foreach ($articles as $article)
    <x-article-list-item :article="$article" />
@endforeach