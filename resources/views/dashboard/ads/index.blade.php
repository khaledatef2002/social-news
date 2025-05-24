@extends('dashboard.layouts.app')

@section('title', __('dashboard.ads'))

@section('content')

@if (Auth::user()->hasPermissionTo('ads_create'))
    <div class="card">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-sm-auto ms-auto">
                    <a href="{{ route('dashboard.ads.create') }}"><button class="btn btn-success"><i class="ri-add-fill me-1 align-bottom"></i> @lang('dashboard.ads.add')</button></a>
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
                    <th>@lang('dashboard.cover')</th>
                    <th>@lang('dashboard.redirect_link')</th>
                    <th>@lang('dashboard.weight')</th>
                    <th>@lang('dashboard.action')</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/ad-module.js') }}" type="module"></script>
    <script>
        var table
        $(document).ready( function () {
            table = $('#dataTables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.ads.index') }}",
                columns: [
                            { data: 'id', name: 'id' },
                            { data: 'title', name: 'title' },
                            { data: 'cover', name: 'cover' },
                            { data: 'redirect_link', name: 'redirect_link' },
                            { data: 'weight', name: 'weight' },
                            { data: 'action', name: 'action'}
                        ]
            });
        });
    </script>
@endsection