@extends('dashboard.layouts.app')

@section('title', __('dashboard.user.create'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.users.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="create-user-form">
    @csrf
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <div class="mb-3 flex-fill">
                            <label for="first_name">@lang('front.first-name')</label>
                            <input id="first_name" type="text" class="form-control ps-4" name="first_name">
                        </div>
                        <div class="mb-3 flex-fill">
                            <label for="last_name">@lang('front.last-name')</label>
                            <input id="last_name" type="text" class="form-control ps-4" name="last_name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">@lang('front.email')</label>
                        <input id="email" type="email" class="form-control ps-4" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="mb-1">@lang('front.password')</label>
                        <div>
                            <input class="form-control" type="password" name="password">
                            <i class="fas fa-eye password-toggler pb-3" role="button"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nid">@lang('front.nid') <span class="text-muted">(@lang('front.optional'))</span></label>
                        <input id="nid" type="text" class="form-control ps-4" name="nid">
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="phone" class="mb-1">@lang('front.phone')</label>
                            <input class="form-control country-selector" type="tel" name="phone" placeholder="@lang('front.phone')">
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="phone_public">@lang('front.show')</label>
                            <input name="phone_public" value="0" type="hidden">
                            <input name="phone_public" value="1" class="form-check-input m-0" value="1" type="checkbox" role="switch" id="phone_public">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="education">@lang('front.education')</label>
                            <select class="form-select" id="education" name="education">
                                @foreach (App\Enum\EducationType::cases() as $education)
                                    <option value="{{ $education->value }}">{{ $education->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="education_public">@lang('front.show')</label>
                            <input class="form-check-input m-0" value="0" name="education_public" type="hidden">
                            <input class="form-check-input m-0" value="1" type="checkbox" role="switch" id="education_public" name="education_public">
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="position">@lang('front.position')</label>
                            <input id="position" name="position" class="form-control ps-4">
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="position_public">@lang('front.show')</label>
                            <input name="position_public" value="0" type="hidden">
                            <input name="position_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="position_public">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="x_link">{{ __('front.platform-profile-link', ['platform' => __('front.x')]) }}:</label>
                            <input id="x_link" class="form-control ps-4" name="x_link">
                            <i class="fa-brands fa-x-twitter ms-1"></i>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="x_link_public">@lang('front.show')</label>
                            <input name="x_link_public" value="0" type="hidden">
                            <input name="x_link_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="x_link_public">
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="facebook_link">{{ __('front.platform-profile-link', ['platform' => __('front.facebook')]) }}:</label>
                            <input id="facebook_link" class="form-control ps-4" name="facebook_link">
                            <i class="fab fa-facebook ms-1"></i>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="facebook_link_public">@lang('front.show')</label>
                            <input name="facebook_link_public" value="0" type="hidden">
                            <input name="facebook_link_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="facebook_link_public">
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="instagram_link">{{ __('front.platform-profile-link', ['platform' => __('front.instagram')]) }}:</label>
                            <input id="instagram_link" class="form-control ps-4" name="instagram_link">
                            <i class="fab fa-instagram ms-1"></i>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="instagram_link_public">@lang('front.show')</label>
                            <input name="instagram_link_public" value="0" type="hidden">
                            <input name="instagram_link_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="instagram_link_public">
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="linkedin_link">{{ __('front.platform-profile-link', ['platform' => __('front.linkedin')]) }}:</label>
                            <input id="linkedin_link" class="form-control ps-4" name="linkedin_link">
                            <i class="fab fa-linkedin ms-1"></i>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="linkedin_link_public">@lang('front.show')</label>
                            <input name="linkedin_link_public" value="0" type="hidden">
                            <input name="linkedin_link_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="linkedin_link_public">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="type">@lang('front.user-type')</label>
                        <select class="form-select" id="type" name="type">
                            @foreach (App\Enum\UserType::cases() as $type)
                                <option value="{{ $type->value }}">{{ __('front.' . strtolower($type->name)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                        <input type="hidden" name="admin" value="0">
                        <input type="checkbox" class="form-check-input" id="admin" name="admin" value="1">
                        <label class="form-check-label" for="admin">Is Admin</label>
                    </div>
                    <div class="mb-3" style="display: none">
                        <label class="form-label" for="role">Role:</label>
                        <select class="form-control" id="role" name="role">
                            <option>@lang('dashboard.select.choose-option')</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">User Image</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="text-center">
                            <div class="position-relative d-inline-block auto-image-show">
                                <div class="position-absolute top-100 start-100 translate-middle">
                                    <label for="image" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                <i class="ri-image-fill"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input class="form-control d-none" name="image" id="image" type="file" accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="avatar-lg">
                                    <div class="avatar-title bg-light rounded">
                                        <img src="" id="product-img" style="min-height: 100%;min-width: 100%;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm">@lang('dashboard.create')</button>
        </div>
    </div>
</form>

@endsection

@section('additional-js-libs')
    

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/users-module.js') }}" type="module"></script>
@endsection