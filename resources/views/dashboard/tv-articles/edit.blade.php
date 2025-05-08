@extends('dashboard.layouts.app')

@section('title', __('dashboard.tv_articles.edit'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.tv-articles.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="edit-tv-article-form" data-id="{{ $tv_article->id }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $value)
                        <div class="mb-3">
                            <label class="form-label" for="{{ $locale }}.title">@lang('dashboard.'.$locale.'.article.title')</label>
                            <input type="text" class="form-control" id="{{ $locale }}.title" value="{{ $tv_article->translate($locale)->title }}" name="{{ $locale }}[title]" placeholder="@lang('dashboard.enter') @lang('dashboard.title')">
                        </div>
                    @endforeach
                    <div class="mb-3">
                        <label class="form-label" for="source">@lang('dashboard.source')</label>
                        <input class="form-control" id="source" name="source" value="{{ $tv_article->source }}" placeholder="@lang('dashboard.enter') @lang('dashboard.source')">
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('dashboard.select_category')</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="category_id">@lang('dashboard.category')</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="{{ $tv_article->category_id }}">{{ $tv_article->category->title }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- end card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('dashboard.enter_keywords')</h5>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="keywords" class="form-label">@lang('dashboard.keywords')</label>
                            <input class="form-control" placeholder="@lang('dashboard.enter') @lang('dashboard.keywords')" value="{{ $tv_article->keywords }}" id="keywords" name="keywords" data-choices data-choices-text-unique-true data-choices-removeItem type="text" />
                        </div>
                    </div>
                </div>
            </div>
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

@section('custom-js')
    <script src="{{ asset('back/js/tv-articles-module.js') }}" type="module"></script>
    <script>
        $(document).ready(function() {
            $('select[name="category_id"]').select2({
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