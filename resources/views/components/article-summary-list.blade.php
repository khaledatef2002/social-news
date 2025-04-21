@if ($articles->count() == 0)
    @foreach ($articles as $article)
        <x-article-summary-list-item :article="$article" />
    @endforeach
@else
    <p class="fw-bold mb-0 fs-5">لا يوجد نتائج اخرى</p>
@endif