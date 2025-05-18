<article class="px-2 col-xl-3 col-md-6 col-12 mb-3 align-self-center">
    <div class="card rounded border-0 shadow-sm h-100">
        <iframe
            src="{{ $tvArticle->embed_source }}" 
            title="YouTube video player" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
        </iframe>
        <div class="py-2 px-2 text-start flex-fill">
            <div class="meta-content d-flex flex-column mb-2 fw-bold flex-fill h-100">
                <div class="d-flex justify-content-between align-items-center flex-fill">
                    <span class="d-flex align-items-center gap-2 w-100 flex-fill h-100">
                        <div class="meta-data d-flex flex-column w-100 h-100">
                            <div class="d-flex justify-content-between align-items-center w-100 flex-fill">
                                <h3 class="fs-4 fw-bold"><a href="{{ route('front.tv-articles.show', $tvArticle) }}" class="text-decoration-none text-dark">{{ $tvArticle->title }}</a></h3>
                            </div>
                            <div class="meta-date-category d-flex justify-content-between align-items-center gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="date fs-7 fw-normal"><i class="far fa-clock fs-"></i> {{ $tvArticle->created_at->locale(app()->getLocale())->diffForHumans() }}</span>
                                    <span class="category fs-7 fw-normal"><i class="fas fa-list-ul"></i> {{ $tvArticle->category->title }}</span>
                                </div>
                                <ul class="p-0 m-0 d-flex gap-3 pe-1">
                                    <a  href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.tv-articles.show', $tvArticle) }}" 
                                        target="_blank"
                                        class="text-decoration-none text-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="مشاركة على فيس بوك">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                    <a  href="https://x.com/intent/tweet?url={{ route('front.tv-articles.show', $tvArticle) }}&text=Check%20this%20out!" 
                                        target="_blank"
                                        class="text-decoration-none text-dark"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="مشاركة على منصة X">
                                        <i class="fab fa-x-twitter"></i>
                                    </a>
                                    <a  href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('front.tv-articles.show', $tvArticle) }}&title=Your%20Title" 
                                        target="_blank"
                                        class="text-decoration-none text-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="مشاركة على لينكد ان">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                    <a  href="https://api.whatsapp.com/send?text={{ route('front.tv-articles.show', $tvArticle) }}" 
                                        target="_blank"
                                        class="text-decoration-none text-success"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="مشاركة على واتساب">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
</article>