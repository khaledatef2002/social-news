<?php

namespace App\Enum;

enum PermissionsType: string
{
    // website settings
    case website_settings_show = 'website_settings_show';
    case website_settings_edit = 'website_settings_edit';

    // articles categories
    case articles_categories_show = 'articles_categories_show';
    case articles_categories_edit = 'articles_categories_edit';
    case articles_categories_delete = 'articles_categories_delete';
    case articles_categories_create = 'articles_categories_create';

    // Tv articles categories
    case tv_articles_categories_show = 'tv_articles_categories_show';
    case tv_articles_categories_edit = 'tv_articles_categories_edit';
    case tv_articles_categories_delete = 'tv_articles_categories_delete';
    case tv_articles_categories_create = 'tv_articles_categories_create';

    // articles
    case articles_show = 'articles_show';
    case articles_delete = 'articles_delete';

    // Tv articles
    case tv_articles_show = 'tv_articles_show';
    case tv_articles_edit = 'tv_articles_edit';
    case tv_articles_delete = 'tv_articles_delete';
    case tv_articles_create = 'tv_articles_create';

    // Writer requests
    case writer_requests_show = 'writer_requests_show';
    case writer_requests_delete = 'writer_requests_delete';
    case writer_requests_edit = 'writer_requests_edit';

    // ads
    case ads_show = 'ads_show';
    case ads_edit = 'ads_edit';
    case ads_delete = 'ads_delete';
    case ads_create = 'ads_create';

    // users
    case users_show = 'users_show';
    case users_edit = 'users_edit';
    case users_delete = 'users_delete';
    case users_create = 'users_create';

    // roles
    case roles_show = 'roles_show';
    case roles_edit = 'roles_edit';
    case roles_delete = 'roles_delete';
    case roles_create = 'roles_create';

    // Contact us
    case contact_us_show = 'contact_us_show';
    case contact_us_delete = 'contact_us_delete';
}
