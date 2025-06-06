@extends('dashboard.layouts.app')

@section('title', __('dashboard.articles.categories'))

@section('content')

@if (Auth::user()->hasPermissionTo('articles_categories_create'))
    <div class="card">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-sm-auto ms-auto">
                    <a data-bs-toggle="modal" data-bs-target="#addArticleCategoryModal">
                        <button class="btn btn-success">
                            <i class="ri-add-fill me-1 align-bottom"></i> 
                            @lang('dashboard.categories.add')
                        </button>
                    </a>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="dataTables">
            <thead>
                <tr class="table-dark">
                    <th>@lang('dashboard.id')</th>
                    <th>@lang('dashboard.title')</th>
                    <th>@lang('dashboard.action')</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addArticleCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('dashboard.articles.categories.add')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('dashboard.close')"></button>
            </div>
            <form id="add-article-category-form">
                @csrf
                <div class="modal-body">
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $values)
                        <div class="mb-3">
                            <label class="form-label" for="{{ $locale }}.title">
                                @lang('dashboard.title') ({{ $values['native'] }})
                            </label>
                            <input type="text" class="form-control" 
                                   id="{{ $locale }}.title" 
                                   name="{{ $locale }}[title]" 
                                   placeholder="@lang('dashboard.enter') @lang('dashboard.title')">
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        @lang('dashboard.close')
                    </button>
                    <button type="submit" class="btn btn-primary">
                        @lang('dashboard.add')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editArticleCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('dashboard.articles.categories.edit')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('dashboard.close')"></button>
            </div>
            <form id="edit-article-category-form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $values)
                        <div class="mb-3">
                            <label class="form-label" for="{{ $locale }}.title">
                                @lang('dashboard.title') ({{ $values['native'] }})
                            </label>
                            <input type="text" class="form-control" 
                                   id="{{ $locale }}.title" 
                                   name="{{ $locale }}[title]" 
                                   placeholder="@lang('dashboard.enter') @lang('dashboard.title')">
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        @lang('dashboard.close')
                    </button>
                    <button type="submit" class="btn btn-primary">
                        @lang('dashboard.edit')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
    <script src="{{ asset('back/js/articles-categories-module.js') }}" type="module"></script>
    <script>
        var table;
        $(document).ready(function() {
            table = $('#dataTables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.articles-categories.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { 
                        data: 'action', 
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    url: "{{ asset('back/js/datatables-lang/' . app()->getLocale() . '.json') }}"
                }
            });
        });
    </script>
@endsection