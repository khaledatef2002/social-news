@extends('dashboard.layouts.app')

@section('title', __('dashboard.roles.edit'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.roles.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="edit-role-form" data-id="{{ $role->id }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="name">@lang('dashboard.roles.name')</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('dashboard.enter') @lang('dashboard.roles.name')" value="{{ $role->name }}">
                    </div>
                </div>
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('dashboard.permissions.module')</th>
                                <th>@lang('dashboard.permissions.permissions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>@lang('dashboard.modules.tv_articles_categories')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_categories_show->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_categories_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_categories_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_categories_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_categories_edit->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_categories_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_categories_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_categories_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_categories_delete->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_categories_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_categories_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_categories_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_categories_create->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_categories_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_categories_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_categories_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.tv_articles')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_show->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_edit->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_delete->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_create->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.articles_categories')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_categories_show->value }}" value="{{ \App\Enum\PermissionsType::articles_categories_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_categories_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_categories_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_categories_edit->value }}" value="{{ \App\Enum\PermissionsType::articles_categories_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_categories_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_categories_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_categories_delete->value }}" value="{{ \App\Enum\PermissionsType::articles_categories_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_categories_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_categories_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_categories_create->value }}" value="{{ \App\Enum\PermissionsType::articles_categories_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_categories_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_categories_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.articles')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_show->value }}" value="{{ \App\Enum\PermissionsType::articles_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_delete->value }}" value="{{ \App\Enum\PermissionsType::articles_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.writer_requests')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::writer_requests_show->value }}" value="{{ \App\Enum\PermissionsType::writer_requests_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::writer_requests_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::writer_requests_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::writer_requests_edit->value }}" value="{{ \App\Enum\PermissionsType::writer_requests_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::writer_requests_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::writer_requests_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::writer_requests_delete->value }}" value="{{ \App\Enum\PermissionsType::writer_requests_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::writer_requests_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::writer_requests_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.ads')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::ads_show->value }}" value="{{ \App\Enum\PermissionsType::ads_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::ads_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::ads_show->value }}">
                                            @lang('dashboard.ads.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::ads_edit->value }}" value="{{ \App\Enum\PermissionsType::ads_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::ads_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::ads_edit->value }}">
                                            @lang('dashboard.ads.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::ads_delete->value }}" value="{{ \App\Enum\PermissionsType::ads_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::ads_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::ads_delete->value }}">
                                            @lang('dashboard.ads.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::ads_create->value }}" value="{{ \App\Enum\PermissionsType::ads_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::ads_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::ads_create->value }}">
                                            @lang('dashboard.ads.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.contact_us')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::contact_us_show->value }}" value="{{ \App\Enum\PermissionsType::contact_us_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::contact_us_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::contact_us_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::contact_us_delete->value }}" value="{{ \App\Enum\PermissionsType::contact_us_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::contact_us_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::contact_us_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.users')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_show->value }}" value="{{ \App\Enum\PermissionsType::users_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_edit->value }}" value="{{ \App\Enum\PermissionsType::users_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_delete->value }}" value="{{ \App\Enum\PermissionsType::users_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_create->value }}" value="{{ \App\Enum\PermissionsType::users_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.roles')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_show->value }}" value="{{ \App\Enum\PermissionsType::roles_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_edit->value }}" value="{{ \App\Enum\PermissionsType::roles_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_delete->value }}" value="{{ \App\Enum\PermissionsType::roles_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_create->value }}" value="{{ \App\Enum\PermissionsType::roles_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.website_settings')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::website_settings_show->value }}" value="{{ \App\Enum\PermissionsType::website_settings_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::website_settings_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::website_settings_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::website_settings_edit->value }}" value="{{ \App\Enum\PermissionsType::website_settings_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::website_settings_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::website_settings_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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

@section('custom-js')
    <script src="{{ asset('back/js/roles-module.js') }}" type="module"></script>
@endsection