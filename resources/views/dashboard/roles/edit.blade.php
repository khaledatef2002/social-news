@extends('dashboard.layouts.app')

@section('title', __('dashboard.roles.create'))

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
                        <label class="form-label" for="name">@lang('dashboard.role.name')</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('dashboard.enter') @lang('dashboard.name')" value="{{ $role->name }}">
                    </div>
                </div>
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('dashboard.page')</th>
                                <th>@lang('dashboard.roles')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>@lang('dashboard.tv_articles_categories')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_categories_show->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_categories_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_categories_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_categories_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_categories_edit->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_categories_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_categories_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_categories_edit->value }}">
                                            @lang('dashboard.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_categories_delete->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_categories_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_categories_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_categories_delete->value }}">
                                            @lang('dashboard.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_categories_create->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_categories_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_categories_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_categories_create->value }}">
                                            @lang('dashboard.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.tv_articles')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_show->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_edit->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_edit->value }}">
                                            @lang('dashboard.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_delete->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_delete->value }}">
                                            @lang('dashboard.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::tv_articles_create->value }}" value="{{ \App\Enum\PermissionsType::tv_articles_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::tv_articles_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::tv_articles_create->value }}">
                                            @lang('dashboard.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.articles_categories')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_categories_show->value }}" value="{{ \App\Enum\PermissionsType::articles_categories_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_categories_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_categories_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_categories_edit->value }}" value="{{ \App\Enum\PermissionsType::articles_categories_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_categories_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_categories_edit->value }}">
                                            @lang('dashboard.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_categories_delete->value }}" value="{{ \App\Enum\PermissionsType::articles_categories_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_categories_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_categories_delete->value }}">
                                            @lang('dashboard.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_categories_create->value }}" value="{{ \App\Enum\PermissionsType::articles_categories_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_categories_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_categories_create->value }}">
                                            @lang('dashboard.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.articles')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_show->value }}" value="{{ \App\Enum\PermissionsType::articles_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::articles_delete->value }}" value="{{ \App\Enum\PermissionsType::articles_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::articles_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::articles_delete->value }}">
                                            @lang('dashboard.delete')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.users')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_show->value }}" value="{{ \App\Enum\PermissionsType::users_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_edit->value }}" value="{{ \App\Enum\PermissionsType::users_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_edit->value }}">
                                            @lang('dashboard.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_delete->value }}" value="{{ \App\Enum\PermissionsType::users_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_delete->value }}">
                                            @lang('dashboard.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_create->value }}" value="{{ \App\Enum\PermissionsType::users_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_create->value }}">
                                            @lang('dashboard.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.roles')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_show->value }}" value="{{ \App\Enum\PermissionsType::roles_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_edit->value }}" value="{{ \App\Enum\PermissionsType::roles_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_edit->value }}">
                                            @lang('dashboard.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_delete->value }}" value="{{ \App\Enum\PermissionsType::roles_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_delete->value }}">
                                            @lang('dashboard.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_create->value }}" value="{{ \App\Enum\PermissionsType::roles_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_create->value }}">
                                            @lang('dashboard.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.website-settings')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::website_settings_show->value }}" value="{{ \App\Enum\PermissionsType::website_settings_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::website_settings_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::website_settings_show->value }}">
                                            @lang('dashboard.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::website_settings_edit->value }}" value="{{ \App\Enum\PermissionsType::website_settings_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::website_settings_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::website_settings_edit->value }}">
                                            @lang('dashboard.edit')
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
    <script src="{{ asset('back/js/roles.js') }}"></script>
@endsection