@extends('front.layouts.main')

@section('content')
    <div class="profile-wraper flex-fill col-md-8 mx-auto py-4">
        <form id="edit-profile" class="d-flex flex-wrap flex-column gap-4" data-id="{{ Auth::id() }}">
            <div class="auto-image-show">
                <input id="image" name="image" type="file" class="profile-img-file-input" accept="image/*" hidden>
                <label for="image" role="button" class="position-relative profile-photo-edit">
                    <div class="user-image-holder d-flex justify-content-center align-items-center shadow-sm" style="width:90px;height:90px;">
                        <img src="{{ $user->display_image }}" alt="article-cover">
                    </div>
                    <i class="fa-solid fa-camera end-0"></i>
                </label>
            </div>
            <div class="card border-0 shadow-sm col-12 align-self-start">
                <div class="card-body">
                    <div class="d-flex gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="first_name">@lang('front.first-name')</label>
                            <input id="first_name" type="text" class="form-control ps-4" value="{{ $user->first_name }}" name="first_name">
                        </div>
                        <div class="flex-fill">
                            <label for="last_name">@lang('front.last-name')</label>
                            <input id="last_name" type="text" class="form-control ps-4" value="{{ $user->last_name }}" name="last_name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">@lang('front.email')</label>
                        <input id="email" type="email" class="form-control ps-4" value="{{ $user->email }}" name="email">
                        <i class="fa-solid fa-envelope ms-1"></i>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="mb-1">@lang('front.password')</label>
                        <div>
                            <input class="form-control" type="password" name="password">
                            <i class="fas fa-eye password-toggler pb-3" role="button"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="nid">@lang('front.nid') <span class="text-muted">(@lang('front.optional'))</span></label>
                        <input id="nid" type="text" class="form-control ps-4" value="{{ $user->nid }}" name="nid">
                        <i class="fa-solid fa-address-card ms-1"></i>
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="phone">@lang('front.phone')</label>
                            <input type="hidden" name="phone_public" value="0">
                            <input id="phone" name="phone" class="form-control country-selector" type="tel" value="{{ $user->phone }}">
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="phone_public">@lang('front.show')</label>
                            <input name="phone_public" value="0" type="hidden">
                            <input name="phone_public" value="1" class="form-check-input m-0" value="1" type="checkbox" role="switch" id="phone_public" {{ $user->phone_public ? 'checked' : '' }}>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="education">@lang('front.education')</label>
                            <select class="form-select" id="education" name="education">
                                @foreach (App\Enum\EducationType::cases() as $education)
                                    <option value="{{ $education->value }}" {{ $user->education == $education->value ? 'selected' : '' }}>{{ $education->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="education_public">@lang('front.show')</label>
                            <input class="form-check-input m-0" value="0" type="hidden" name="education_public">
                            <input class="form-check-input m-0" value="1" type="checkbox" role="switch" id="education_public" name="education_public" {{ $user->education_public ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="position">@lang('front.position')</label>
                            <input id="position" name="position" class="form-control ps-4" value="{{ $user->position }}">
                            <i class="fa-solid fa-briefcase ms-1"></i>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="position_public">@lang('front.show')</label>
                            <input name="position_public" value="0" type="hidden">
                            <input name="position_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="position_public" {{ $user->position_public ? 'checked' : '' }}>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="x_link">{{ __('front.platform-profile-link', ['platform' => __('front.x')]) }}:</label>
                            <input id="x_link" class="form-control ps-4" name="x_link" value="{{ $user->x_link }}">
                            <i class="fa-brands fa-x-twitter ms-1"></i>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="x_link_public">@lang('front.show')</label>
                            <input name="x_link_public" value="0" type="hidden">
                            <input name="x_link_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="x_link_public" {{ $user->x_link_public ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="facebook_link">{{ __('front.platform-profile-link', ['platform' => __('front.facebook')]) }}:</label>
                            <input id="facebook_link" class="form-control ps-4" name="facebook_link" value="{{ $user->facebook_link }}">
                            <i class="fab fa-facebook ms-1"></i>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="facebook_link_public">@lang('front.show')</label>
                            <input name="facebook_link_public" value="0" type="hidden">
                            <input name="facebook_link_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="facebook_link_public" {{ $user->facebook_link_public ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="instagram_link">{{ __('front.platform-profile-link', ['platform' => __('front.instagram')]) }}:</label>
                            <input id="instagram_link" class="form-control ps-4" name="instagram_link" value="{{ $user->instagram_link }}">
                            <i class="fab fa-instagram ms-1"></i>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="instagram_link_public">@lang('front.show')</label>
                            <input name="instagram_link_public" value="0" type="hidden">
                            <input name="instagram_link_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="instagram_link_public" {{ $user->instagram_link_public ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-2 w-100 mb-3">
                        <div class="flex-fill">
                            <label for="linkedin_link">{{ __('front.platform-profile-link', ['platform' => __('front.linkedin')]) }}:</label>
                            <input id="linkedin_link" class="form-control ps-4" name="linkedin_link" value="{{ $user->linkedin_link }}">
                            <i class="fab fa-linkedin ms-1"></i>
                        </div>
                        <div class="form-check form-switch d-flex flex-column justify-content-center px-2">
                            <label class="form-check-label mb-1" for="linkedin_link_public">@lang('front.show')</label>
                            <input name="linkedin_link_public" value="0" type="hidden">
                            <input name="linkedin_link_public" value="1" class="form-check-input m-0" type="checkbox" role="switch" id="linkedin_link_public" {{ $user->linkedin_link_public ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success">@lang('front.save')</button>
        </form>
    </div>
@endsection