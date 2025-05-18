@extends('front.layouts.main')

@section('content')
    <div class="home-wraper flex-fill d-flex justify-content-between py-4">
        <main class="writers col-12 d-flex flex-wrap justify-content-start align-self-start gap-3 px-3">
            <div class="w-100 d-flex justify-content-center mb-3">
                <h3 class="align-self-start mx-auto d-block"><i class="fas fa-cut fs-4"></i> @lang('front.writers')</h3>
            </div>
            <div class="px-0 col-xl-4 col-md-5 col-12 position-relative">
                <input type="text" name="search" placeholder="@lang('front.search')" class="form-control">
                <i class="fas fa-search position-absolute end-0 me-2" style="top: 12px;"></i>
            </div>
            <div class="row w-100">
                <x-writers-list :writers="$first_writers" />
            </div>
            <div class="gettingWritersLoader justify-content-center w-100 align-item-center">
                <span class="loader"></span>
            </div>
        </main>
    </div>
@endsection

@section('js-after')
    <script>
        const lang = document.querySelector('html').getAttribute('lang')
        let LastWriterId = {{ $first_writers->last()?->id | null }}
    </script>
@endsection