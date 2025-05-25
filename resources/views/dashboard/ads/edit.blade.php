@extends('dashboard.layouts.app')

@section('title', __('dashboard.ads.edit'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center g-2">
            <p class="mb-0">@lang('dashboard.viewd'): {{ $ad->current_views }}</p>
            <div>
                <a href="{{ route('dashboard.ads.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
<form id="edit-ad-form" data-id="{{ $ad->id }}">
    @csrf
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('dashboard.cover')</h5>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <div class="text-center">
                            <div class="position-relative d-inline-block auto-image-show w-100">
                                <div class="mb-0 w-100" role="button">
                                    <label for="cover" class="mb-0 w-100" title="Select Image">
                                        <div class="avatar-lg w-100">
                                            <div class="avatar-title bg-light rounded overflow-hidden" style="height:unset">
                                                <img src="{{ asset($ad->cover) }}" id="product-img" style="min-height: 100%;min-width: 100%;" />
                                            </div>
                                        </div>
                                    </label>
                                    <input class="form-control d-none" name="cover" id="cover" type="file" accept="image/png, image/gif, image/jpeg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title">@lang('dashboard.title')</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ $ad->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="redirect_link">@lang('dashboard.redirect_link')</label>
                        <input id="redirect_link" type="text" class="form-control" name="redirect_link" value="{{ $ad->redirect_link }}">
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="mb-1">@lang('dashboard.weight')</label>
                        <select id="weight" name="weight" class="form-select">
                            <option value="1" {{ $ad->weight() == 1 ? 'selected':'' }}>1</option>
                            <option value="2" {{ $ad->weight() == 2 ? 'selected':'' }}>2</option>
                            <option value="3" {{ $ad->weight() == 3 ? 'selected':'' }}>3</option>
                            <option value="4" {{ $ad->weight() == 4 ? 'selected':'' }}>4</option>
                            <option value="5" {{ $ad->weight() == 5 ? 'selected':'' }}>5</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_counted" value="0">
                            <input class="form-check-input" type="checkbox" {{ $ad->is_counted ? 'checked' : '' }} value="1" role="switch" id="is_counted" name="is_counted">
                            <label class="form-check-label" for="is_counted">@lang('dashboard.ads.is_counted')</label>
                        </div>
                    </div>
                    <div class="mb-3 {{ $ad->is_counted ? '' : 'd-none' }}">
                        <label for="max_views">@lang('dashboard.max_views')</label>
                        <input id="max_views" type="text" class="form-control" name="max_views" value="{{ $ad->max_views }}">
                    </div>
                    <hr>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_start_date" value="0">
                            <input class="form-check-input" type="checkbox" {{ $ad->start_date ? 'checked' : '' }} value="1" role="switch" id="is_start_date" name="is_start_date">
                            <label class="form-check-label" for="is_start_date">@lang('dashboard.ads.is_start_date')</label>
                        </div>
                    </div>
                    <div class="mb-3 {{ $ad->start_date ? '' : 'd-none' }}">
                        <label for="start_date">@lang('dashboard.ads.start_date')</label>
                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="Y-m-d" id="start_date" name="start_date" value="{{ $ad->start_date ? $ad->start_date->format('Y-m-d H:i:s') : '' }}" data-enable-time="" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_end_date" value="0">
                            <input class="form-check-input" type="checkbox" {{ $ad->end_date ? 'checked' : '' }} value="1" role="switch" id="is_end_date" name="is_end_date">
                            <label class="form-check-label" for="is_end_date">@lang('dashboard.ads.is_end_date')</label>
                        </div>
                    </div>
                    <div class="mb-3 {{ $ad->end_date ? '' : 'd-none' }}">
                        <label for="end_date">@lang('dashboard.ads.end_date')</label>
                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="Y-m-d" id="end_date" name="end_date" value="{{ $ad->end_date ? $ad->end_date->format('Y-m-d H:i:s') : '' }}" data-enable-time="" readonly="readonly">
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('dashboard.pages')</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="pages" class="mb-1">@lang('dashboard.pages')</label>
                        <select id="pages" class="form-select" multiple="multiple" name="pages[]">
                            <option value="home" {{ $ad->pages()->where('page', 'home')->count() > 0 ? 'selected' : '' }}>@lang('dashboard.home')</option>
                            <option value="about" {{ $ad->pages()->where('page', 'about')->count() > 0 ? 'selected' : '' }}>@lang('dashboard.about')</option>
                            <option value="contact" {{ $ad->pages()->where('page', 'contact')->count() > 0 ? 'selected' : '' }}>@lang('dashboard.contact')</option>
                            <option value="media" {{ $ad->pages()->where('page', 'media')->count() > 0 ? 'selected' : '' }}>@lang('dashboard.media')</option>
                            <option value="writers" {{ $ad->pages()->where('page', 'writers')->count() > 0 ? 'selected' : '' }}>@lang('dashboard.writers')</option>
                            <option value="summaries" {{ $ad->pages()->where('page', 'summaries')->count() > 0 ? 'selected' : '' }}>@lang('dashboard.summaries')</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- end card -->
            {{-- @dd($ad->categories) --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('dashboard.articles_categories')</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="articles_categories" class="mb-1">@lang('dashboard.articles_categories')</label>
                        <select id="articles_categories" class="form-select" multiple="multiple" name="articles_categories[]">
                            @foreach ($ad->categories as $category)
                                <option value="{{ $category->category_id }}" selected>{{ $category->category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('dashboard.media_categories')</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="media_categories" class="mb-1">@lang('dashboard.media_categories')</label>
                        <select id="media_categories" class="form-select" multiple="multiple" name="media_categories[]">
                            @foreach ($ad->mediaCategories as $category)
                                <option value="{{ $category->category_id }}" selected>{{ $category->category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm">@lang('dashboard.save')</button>
        </div>
    </div>
</form>

@endsection

@section('additional-js-libs')
    

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/ad-module.js') }}" type="module"></script>
    <script>
        $(document).ready(function() {
            $('select[name="pages[]"]').select2()
            $('select[name="articles_categories[]"]').select2({
                placeholder: "@lang('dashboard.select.choose_option')",
                ajax: {
                    url: '{{ route("select2.article_category") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function(category) {
                                return {
                                    id: category.id,
                                    text: category.translations.find(t => t.locale == '{{ LaravelLocalization::getCurrentLocale() }}').title
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0
            });
            $('select[name="media_categories[]"]').select2({
                placeholder: "@lang('dashboard.select.choose_option')",
                ajax: {
                    url: '{{ route("select2.tv_article_category") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function(category) {
                                return {
                                    id: category.id,
                                    text: category.translations.find(t => t.locale == '{{ LaravelLocalization::getCurrentLocale() }}').title
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0
            });
        });
    </script>
@endsection