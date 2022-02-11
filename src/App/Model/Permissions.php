<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Response;

class Permissions extends Model {

    public function getAllPermissions() {
        try {
            $reflectionClass = new ReflectionClass($this);
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
}
