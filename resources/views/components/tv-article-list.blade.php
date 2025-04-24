@if ($tvArticles->count() > 0)
    @foreach ($tvArticles as $tv_article)
        <x-tv-article-list-item :tvArticle="$tv_article" />
    @endforeach
@else
    <p class="fw-bold mb-0 fs-5 text-center">لا يوجد نتائج اخرى</p>
@endif