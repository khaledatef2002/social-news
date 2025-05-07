@extends('dashboard.layouts.app')

@section('title', __('dashboard.website-settings'))

@section('content')

<div class="position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg profile-setting-img auto-image-show">
        <form id="website-banner-change-form" class="h-100">
            @csrf
            <img src="{{ asset($website_settings->banner) }}" class="profile-wid-img" alt="">
            <div class="overlay-content">
                <div class="text-end p-3">
                    @if (Auth::user()->hasPermissionTo('website_settings_edit'))
                        <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                            <input id="website-banner" name="banner" type="file" class="profile-foreground-img-file-input">
                            <label for="website-banner" class="profile-photo-edit btn btn-light">
                                <i class="ri-image-edit-line align-bottom me-1"></i> @lang('dashboard.website-banner')
                            </label>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-xxl-3">
        <div class="card mt-n5">
            <div class="card-body p-4">
                <div class="text-center">
                    <div class="profile-user position-relative d-inline-block mx-auto auto-image-show mb-4">
                        <form id="website-logo-change-form">
                            @csrf
                            <img src="{{ asset($website_settings->logo) }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <input id="profile-img-file-input" name="logo" type="file" class="profile-img-file-input">
                                @if (Auth::user()->hasPermissionTo('website_settings_edit'))
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                @endif
                            </div>
                        </form>
                    </div>
                    <h5 class="fs-16 mb-1">@lang('dashboard.website-logo')</h5>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-9">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#generalInfo" role="tab">
                            <i class="fas fa-home"></i> @lang('dashboard.website-settings')
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="generalInfo" role="tabpanel">
                        <form id="website-settings-change-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">@lang('dashboard.website-title')</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $website_settings->title }}" placeholder="@lang('dashboard.enter') @lang('dashboard.website-title')">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="keywords" class="form-label">@lang('dashboard.website-keywords')</label>
                                        <input class="form-control" placeholder="@lang('dashboard.enter') @lang('dashboard.website-keywords')" id="keywords" name="keywords" data-choices data-choices-text-unique-true data-choices-removeItem type="text" value="{{ $website_settings->keywords }}" />
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="description">@lang('dashboard.website-description')</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="@lang('dashboard.enter') @lang('dashboard.websitedescription')">{{ $website_settings->description }}</textarea>
                                    </div>
                                </div>
                                <!--end col-->
                                @if (Auth::user()->hasPermissionTo('website_settings_edit'))
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">@lang('dashboard.save')</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                @endif
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

@endsection
@section('custom-js')
    <script src="{{ asset('back/js/website-settings-module.js') }}" type="module"></script>
@endsection