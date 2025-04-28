<article class="px-2 col-xl-3 col-md-6 col-12 mb-3" data-article-id="{{ $article->id }}">
    <div class="card h-100 rounded border-0 shadow-sm">
        <div class="py-2 px-2 text-start flex-fill d-flex flex-column">
            <div class="meta-content d-flex flex-column mb-2 fw-bold">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="d-flex align-items-center gap-2">
                        <a href="{{ route('front.profile.show', $article->user) }}">
                            <div class="user-image-holder">
                                <img src="{{ $article->user->display_image }}">
                            </div>
                        </a>
                        <div class="meta-data d-flex flex-column">
                            <span class="user fs-4">
                                <a href="{{ route('front.profile.show', $article->user) }}" class="text-dark text-decoration-none">{{ $article->user->full_name }}</a>
                            </span>
                            <div class="meta-date-category d-flex align-items-center gap-3">
                                <span class="date fs-7 fw-normal"><i class="far fa-clock fs-"></i> {{ $article->created_at->locale(app()->getLocale())->diffForHumans() }}</span>
                                <span class="category fs-7 fw-normal"><i class="fas fa-list-ul"></i> {{ $article->category->title }}</span>
                            </div>
                        </div>
                    </span>
                    @if (Auth::id() == $article->user->id)
                        <div class="dropdown article_action_list">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="user_save_article_action dropdown-item d-flex gap-2 align-items-center {{ Auth::user()?->saved_article($article->id) ? 'saved' : '' }}" role="button"><i class="{{ Auth::user()?->saved_article($article->id) ? 'fas' : 'far' }} fa-bookmark"></i> {{ Auth::user()?->saved_article($article->id) ? 'إزالة من المفضلات' : 'حفظ في المفضلات' }}</li>
                                    <a href="{{ route('front.articles.edit', $article) }}" class="text-decoration-none"><li class="dropdown-item d-flex gap-2 align-items-center" role="button"><i class="fas fa-pen"></i> تعديل المقالة</li></a>
                                <li class="dropdown-item d-flex gap-2 align-items-center remove_article" role="button"><i class="fas fa-trash-alt"></i> إزالة المقالة</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <h3 class="fs-5 fw-bold pt-2 flex-fill d-flex align-items-center"><a href="{{ route('front.articles.show', $article) }}" class="text-decoration-none text-dark">{{ $article->title }}</a></h3>
        </div>
        <a href="{{ route('front.articles.show', $article) }}">
            <div class="image-holder">
                <img src="{{ $article->cover }}" />
            </div>
        </a>
        <div class="reacts-container">
            <div class="reacts_count px-2 py-1 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-1">
                    <i class="fas fa-heart text-danger"></i>
                    <span class="count fw-bold">{{ $article->reacts()->count() }}</span>
                </div>
                <ul class="p-0 m-0 d-flex gap-3 pe-1">
                    <a  href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.articles.show', $article) }}" 
                        target="_blank"
                        class="text-decoration-none text-primary"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="مشاركة على فيس بوك">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a  href="https://x.com/intent/tweet?url={{ route('front.articles.show', $article) }}&text=Check%20this%20out!" 
                        target="_blank"
                        class="text-decoration-none text-dark"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="مشاركة على منصة X">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    <a  href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('front.articles.show', $article) }}&title=Your%20Title" 
                        target="_blank"
                        class="text-decoration-none text-primary"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="مشاركة على لينكد ان">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a  href="https://api.whatsapp.com/send?text={{ route('front.articles.show', $article) }}" 
                        target="_blank"
                        class="text-decoration-none text-success"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="مشاركة على واتساب">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </ul>
            </div>
            @auth
                <button class="heart_action_button bg-white loader-btn {{ $article->isAuthReacted() ? 'reacted' : '' }} fw-bold fs-6 d-flex gap-2 justify-content-center align-items-center">
                    <p>
                        <i class="{{ $article->isAuthReacted() ? 'fas' : 'far' }} fa-heart"></i>
                        أحببته
                    </p>
                    <span class="loader"></span>
                </button>
            @endauth
        </div>
    </div>
</article>