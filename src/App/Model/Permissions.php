<?php

namespace App\Model;

use ReflectionClass;
use Symfony\Component\HttpFoundation\Response;

class Permissions {

    public static function getAllPermissions() {
        try {
            $reflectionClass = new ReflectionClass(self::class);
            return $reflectionClass->getConstants();
        } catch (\ReflectionException $e) {
            return new Response('An error occurred', 500);
        }
    }

    public const __ADMIN__ = 'admin';

    public const __VIEW_CMS_PAGE__ = 'view_cms_page';
    public const __VIEW_CMS_PERFORMER_OVERVIEW_PAGE__ = 'view_cms_performer_overview_page';
    public const __VIEW_CMS_LOCATION_OVERVIEW_PAGE__ = 'view_cms_location_overview_page';
    public const __VIEW_CMS_RESTAURANT_OVERVIEW_PAGE__ = 'view_cms_restaurant_overview_page';
    public const __VIEW_CMS_ROLES_OVERVIEW_PAGE__ = 'view_cms_roles_overview_page';
    public const __VIEW_CMS_USERS_OVERVIEW_PAGE__ = 'view_cms_users_overview_page';
    public const __VIEW_CMS_EVENT_OVERVIEW_PAGE__ = 'view_cms_event_overview_page';
    public const __VIEW_CMS_PROGRAM_OVERVIEW_PAGE__ = 'view_cms_program_overview_page';

    public const __VIEW_CMS_VIEW_EVENT_PAGE__ = 'view_cms_view_event_page';

    public const __CREATE_NEW_PROGRAM__ = 'create_new_program';

    public const __VIEW_LOCATION_PAGE__ = 'view_location_page';
    public const __WRITE_LOCATION_PAGE__ = 'write_location_page';

    public const __VIEW_PERFORMER_PAGE__ = 'view_performer_page';
    public const __WRITE_PERFORMER_PAGE__ = 'write_performer_page';

    public const __VIEW_RESTAURANT_PAGE__ = 'view_restaurant_page';
    public const __WRITE_RESTAURANT_PAGE__ = 'write_restaurant_page';

    public const __VIEW_USER_PAGE__ = 'view_user_page';
    public const __WRITE_USER_PAGE__ = 'write_user_page';

    public const __VIEW_ROLES_PAGE__ = 'view_roles_page';
    public const __WRITE_ROLES_PAGE__ = 'write_roles_page';

    public const __VIEW_EVENT_PAGE__ = 'view_event_page';
    public const __WRITE_EVENT_PAGE__ = 'write_event_page';

    public const __VIEW_ITEM_PAGE__ = 'view_item_page';
    public const __WRITE_ITEM_PAGE__ = 'write_item_page';
}
