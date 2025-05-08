@extends('dashboard.layouts.app')

@section('title', __('dashboard.articles'))

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="dataTables">
            <thead>
                <tr class="table-dark">
                    <th>@lang('dashboard.id')</th>
                    <th>@lang('dashboard.cover')</th>
                    <th>@lang('dashboard.title')</th>
                    <th>@lang('dashboard.category')</th>
                    <th>@lang('dashboard.reacts')</th>
                    <th>@lang('dashboard.user')</th>
                    <th>@lang('dashboard.action')</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('custom-js')
    <script src="{{ asset('back/js/articles-module.js') }}" type="module"></script>
    <script>
        var table
        $(document).ready( function () {
            table = $('#dataTables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.articles.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'cover', name: 'cover' },
                    { data: 'title', name: 'title' },
                    { data: 'category', name: 'category' },
                    { data: 'reacts', name: 'reacts' },
                    { data: 'user', name: 'user' },
                    { data: 'action', name: 'action'}
                ]
            });
        });
    </script>
@endsection