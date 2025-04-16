<article class="card rounded border shadow-sm">
    <div class="py-2 px-2 text-start">
        <div class="meta-content d-flex flex-column mb-2 fw-bold">
            <div class="d-flex justify-content-between align-items-center">
                <span class="d-flex align-items-center gap-2">
                    <div class="user-image-holder">
                        <img src="{{ $article->user->display_image }}">
                    </div>
                    <div class="meta-data d-flex flex-column">
                        <span class="user fs-4">{{ $article->user->first_name }}</span>
                        <div class="meta-date-category d-flex align-items-center gap-3">
                            <span class="date fs-7 fw-normal"><i class="far fa-clock fs-"></i> {{ $article->created_at->locale(app()->getLocale())->diffForHumans() }}</span>
                            <span class="category fs-7 fw-normal"><i class="fas fa-list-ul"></i> {{ $article->category->title }}</span>
                        </div>
                    </div>
                </span>
                <div class="dropdown article_action_list">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end2">
                        <li class="dropdown-item d-flex gap-2 align-items-center" role="button"><i class="far fa-bookmark"></i> حفظ في المفضلات</li>
                        @if (Auth::id() == $article->user->id)
                            <a href="{{ route('front.articles.edit', $article) }}" class="text-decoration-none"><li class="dropdown-item d-flex gap-2 align-items-center" role="button"><i class="fas fa-pen"></i> تعديل المقالة</li></a>
                            <li class="dropdown-item d-flex gap-2 align-items-center remove_article" data-article-slug="{{ $article->slug }}" role="button"><i class="fas fa-trash-alt"></i> إزالة المقالة</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <h3 class="fs-5 fw-bold pt-2"><a href="{{ route('front.articles.show', $article) }}" class="text-decoration-none text-dark">{{ $article->title }}</a></h3>
    </div>
    <div class="image-holder overflow-hidden">
        <a href="{{ route('front.articles.show', $article) }}">
            <img src="{{ $article->cover }}" />
        </a>
    </div>
    <div class="reacts-container">
        <div class="reacts_count px-2 py-1 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-1">
                <i class="fas fa-heart text-danger"></i>
                <span class="count fw-bold">0</span>
            </div>
            @if(!Auth::user())
                <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none">سجل دخول لتتمكن من التفاعل</a>
            @endif
        </div>
        @auth
            <button class="heart_action_button loader-btn {{ $article->isAuthReacted() ? 'reacted' : '' }} fw-bold fs-6 d-flex gap-2 justify-content-center align-items-center">
                <p>
                    <i class="{{ $article->isAuthReacted() ? 'fas' : 'far' }} fa-heart"></i>
                    أحببته
                </p>
                <span class="loader"></span>
            </button>
        @endauth
    </div>
</article>