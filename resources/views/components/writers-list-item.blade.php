<a href="{{ route('front.profile.show', $writer) }}" class="col-xl-4 col-md-6 col-12 px-3 mb-3 text-decoration-none">
    <article data-writer-id="{{ $writer->id }}">
        <div class="card h-100 rounded border-0 shadow-sm">
            <div class="card-body py-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex gap-2 align-items-center">
                            <div class="user-image-holder">
                                <img src="{{ $writer->display_image }}">
                            </div>
                        <span class="user text-dark fw-bold fs-5">
                            {{ $writer->full_name }}
                        </span>
                    </div>
                    <div class="badge text-bg-dark px-3 py-2 d-flex gap-2 fw-bold">
                        <i class="fas fa-pen-alt"></i>
                        {{ $writer->articles->count() }}
                    </div>
                </div>
            </div>
        </div>
    </article>
</a>