@extends('dashboard.layouts.app')

@section('title', __('dashboard.writer-requests'))

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="dataTables">
            <thead>
                <tr class="table-dark">
                    <th>@lang('dashboard.id')</th>
                    <th>@lang('dashboard.user')</th> 
                    <th>@lang('dashboard.status')</th> 
                    <th>@lang('dashboard.action')</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('custom-js')
    <script src="{{ asset('back/js/writer-requests-module.js') }}" type="module"></script>
    <script>
        var table
        $(document).ready( function () {
            table = $('#dataTables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.writer-request.index') }}",
                columns: [
                            { data: 'id', name: 'id' },
                            { data: 'user', name: 'user' },
                            { data: 'status', name: 'status' },
                            { data: 'action', name: 'action'}
                        ]
            });
        });
    </script>
@endsection