<?php

use App\Http\Controller\Admin\AdminEventController;
use App\Http\Controller\Admin\AdminItemController;
use App\Http\Controller\Admin\AdminLocationsController;
use App\Http\Controller\Admin\AdminMainController;
use App\Http\Controller\Admin\AdminPerformerController;
use App\Http\Controller\Admin\AdminProgramController;
use App\Http\Controller\Admin\AdminRestaurantController;
use App\Http\Controller\Admin\AdminRestaurantTypesController;
use App\Http\Controller\Admin\AdminRolesController;
use App\Http\Controller\Admin\AdminSessionController;
use App\Http\Controller\Admin\AdminUsersController;
use App\Http\Controller\HomeController;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\Auth\RegisterController;
use App\Http\Controller\EventController;
use App\Http\Controller\RestaurantController;
use App\Http\Controller\FrontendController;
use App\Http\Controller\EmailController;
use App\Http\Controller\QRController;
use App\Http\Controller\ContactController;
use Matrix\Managers\RouteManager;
use \App\Http\Controller\CartController;

$routes = [
    // basic routes
    ["name" => "home", "url" => "/", "controller" => [new HomeController(), 'index'], "method" => "GET"],
    ["name" => "contact", "url" => "/contact", "controller" => [new ContactController(), 'index'], "method" => "GET"],
    ["name" => "login", "url" => "/login", "controller" => [new LoginController(), 'index'], "method" => "GET"],
    ["name" => "login_post", "url" => "/login", "controller" => [new LoginController(), 'login'], "method" => "POST"],
    ["name" => "register", "url" => "/register", "controller" => [new RegisterController(), 'index'], "method" => "GET"],
    ["name" => "register_post", "url" => "/register", "controller" => [new RegisterController(), 'register'], "method" => "POST"],

    // cart routes
    ["name" => "cart", "url" => "/cart", "controller" => [new CartController(), 'index'], "method" => "GET"],
    ["name" => "cart_pay", "url" => "/cart/pay", "controller" => [new CartController(), 'pay'], "method" => "GET"],

    // Food routes
    ["name" => "food", "url" => "/food", "controller" => [new RestaurantController(), 'index'], "method" => "GET"],
    ["name" => "restaurant_single", "url" => "/food/restaurant/{id}", "controller" => [new RestaurantController(), 'single'], "method" => "GET"],

    // Admin routes
    ["name" => "admin", "url" => "/admin", "controller" => [new AdminMainController(), 'index'], "method" => "GET"],

    ["name" => "admin_performers", "url" => "/admin/performers", "controller" => [new AdminPerformerController(), 'index'], "method" => "GET"],
    ["name" => "admin_performers_search", "url" => "/admin/performers/{search}", "controller" => [new AdminPerformerController(), 'search'], "method" => "GET"],
    ["name" => "admin_performers_save", "url" => "/admin/performer/create", "controller" => [new AdminPerformerController(), 'save'], "method" => "POST"],
    ["name" => "admin_performers_single", "url" => "/admin/performer/update/{id}", "controller" => [new AdminPerformerController(), 'single'], "method" => "GET"],
    ["name" => "admin_performers_update", "url" => "/admin/performer/update/{id}", "controller" => [new AdminPerformerController(), 'update'], "method" => "POST"],
    ["name" => "admin_performers_delete", "url" => "/admin/performer/delete/{id}", "controller" => [new AdminPerformerController(), 'delete'], "method" => "POST"],
    ["name" => "admin_performers_paginator", "url" => "/admin/performer/{page}/{amount}", "controller" => [new AdminPerformerController(), 'show'], "method" => "GET"],

    ["name" => "admin_locations", "url" => "/admin/locations", "controller" => [new AdminLocationsController(), 'index'], "method" => "GET"],
    ["name" => "admin_locations_search", "url" => "/admin/locations/{search}", "controller" => [new AdminLocationsController(), 'search'], "method" => "GET"],
    ["name" => "admin_locations_save", "url" => "/admin/location/create", "controller" => [new AdminLocationsController(), 'save'], "method" => "POST"],
    ["name" => "admin_locations_single", "url" => "/admin/location/update/{id}", "controller" => [new AdminLocationsController(), 'single'], "method" => "GET"],
    ["name" => "admin_locations_update", "url" => "/admin/location/update/{id}", "controller" => [new AdminLocationsController(), 'update'], "method" => "POST"],
    ["name" => "admin_locations_delete", "url" => "/admin/location/delete/{id}", "controller" => [new AdminLocationsController(), 'delete'], "method" => "POST"],
    ["name" => "admin_locations_paginator", "url" => "/admin/location/{page}/{amount}", "controller" => [new AdminLocationsController(), 'show'], "method" => "GET"],

    ["name" => "admin_restaurants", "url" => "/admin/restaurants", "controller" => [new AdminRestaurantController(), 'index'], "method" => "GET"],

    ["name" => "admin_roles", "url" => "/admin/roles", "controller" => [new AdminRolesController(), 'index'], "method" => "GET"],
    ["name" => "admin_roles_search", "url" => "/admin/roles/{search}", "controller" => [new AdminRolesController(), 'search'], "method" => "GET"],
    ["name" => "admin_roles_save", "url" => "/admin/roles/create", "controller" => [new AdminRolesController(), 'save'], "method" => "POST"],
    ["name" => "admin_roles_single", "url" => "/admin/roles/update/{id}", "controller" => [new AdminRolesController(), 'single'], "method" => "GET"],
    ["name" => "admin_roles_update", "url" => "/admin/roles/update/{id}", "controller" => [new AdminRolesController(), 'update'], "method" => "POST"],
    ["name" => "admin_roles_delete", "url" => "/admin/roles/delete/{id}", "controller" => [new AdminRolesController(), 'delete'], "method" => "POST"],
    ["name" => "admin_roles_paginator", "url" => "/admin/roles/{page}/{amount}", "controller" => [new AdminRolesController(), 'show'], "method" => "GET"],

    ["name" => "admin_users", "url" => "/admin/users", "controller" => [new AdminUsersController(), 'index'], "method" => "GET"],
    ["name" => "admin_users_roles", "url" => "/admin/users/roles", "controller" => [new AdminUsersController(), 'roles'], "method" => "GET"],
    ["name" => "admin_users_search", "url" => "/admin/users/{search}", "controller" => [new AdminUsersController(), 'search'], "method" => "GET"],
    ["name" => "admin_users_save", "url" => "/admin/users/create", "controller" => [new AdminUsersController(), 'save'], "method" => "POST"],
    ["name" => "admin_users_single", "url" => "/admin/users/update/{id}", "controller" => [new AdminUsersController(), 'single'], "method" => "GET"],
    ["name" => "admin_users_update", "url" => "/admin/users/update/{id}", "controller" => [new AdminUsersController(), 'update'], "method" => "POST"],
    ["name" => "admin_users_delete", "url" => "/admin/users/delete/{id}", "controller" => [new AdminUsersController(), 'delete'], "method" => "POST"],
    ["name" => "admin_users_paginator", "url" => "/admin/users/{page}/{amount}", "controller" => [new AdminUsersController(), 'show'], "method" => "GET"],

    ["name" => "admin_event", "url" => "/admin/events", "controller" => [new AdminEventController(), "index"], "method" => "GET"],
    ["name" => "admin_event_overview", "url" => "/admin/event/overview/{id}", "controller" => [new AdminEventController(), 'overview'], "method" => "POST"],
    ["name" => "admin_event_show", "url" => "/admin/event/{id}", "controller" => [new AdminEventController(), 'show'], "method" => "GET"],
    ["name" => "admin_event_save", "url" => "/admin/event/create", "controller" => [new AdminEventController(), 'save'], "method" => "POST"],
    ["name" => "admin_event_single", "url" => "/admin/event/update/{id}", "controller" => [new AdminEventController(), 'single'], "method" => "GET"],
    ["name" => "admin_event_update", "url" => "/admin/event/update/{id}", "controller" => [new AdminEventController(), 'update'], "method" => "POST"],
    ["name" => "admin_event_delete", "url" => "/admin/event/delete/{id}", "controller" => [new AdminEventController(), 'delete'], "method" => "POST"],

    ["name" => "admin_sessions", "url" => "/admin/restaurants", "controller" => [new AdminSessionController(), 'index'], "method" => "GET"],
    ["name" => "admin_restaurant_types", "url" => "/admin/restaurants", "controller" => [new AdminRestaurantTypesController(), 'index'], "method" => "GET"],

    ["name" => "admin_program_create", "url" => "/admin/program/create", "controller" => [new AdminProgramController(), 'create'], "method" => "POST"],
    ["name" => "admin_program_show", "url" => "/admin/program/{id}", "controller" => [new AdminProgramController(), 'show'], "method" => "GET"],
    ["name" => "admin_program_single", "url" => "/admin/program/single/{id}", "controller" => [new AdminProgramController(), 'single'], "method" => "GET"],
    ["name" => "admin_program_update", "url" => "/admin/program/update/{id}", "controller" => [new AdminProgramController(), 'update'], "method" => "POST"],
    ["name" => "admin_program_delete", "url" => "/admin/program/delete/{id}", "controller" => [new AdminProgramController(), 'delete'], "method" => "POST"],

    ["name" => "admin_item_locations", "url" => "/admin/item/locations", "controller" => [new AdminItemController(), 'locations'], "method" => "GET"],
    ["name" => "admin_item_performers", "url" => "/admin/item/performers", "controller" => [new AdminItemController(), 'performers'], "method" => "GET"],
    ["name" => "admin_item_save", "url" => "/admin/item/save", "controller" => [new AdminItemController(), 'save'], "method" => "POST"],
    ["name" => "admin_item_single", "url" => "/admin/item/single/{id}", "controller" => [new AdminItemController(), 'single'], "method" => "GET"],
    ["name" => "admin_item_update", "url" => "/admin/item/update/{id}", "controller" => [new AdminItemController(), 'update'], "method" => "POST"],
    ["name" => "admin_item_delete", "url" => "/admin/item/delete/{id}", "controller" => [new AdminItemController(), 'delete'], "method" => "POST"],

    // Test routes
    ["name" => "test", "url" => "/event/{title}", "controller" => [new EventController(), "index"], "method" => "GET"],

    ["name" => "test_email", "url" => "/emailtest", "controller" => [new EmailController(), 'index'], "method" => "GET"],
    ["name" => "test_email_post", "url" => "/emailtest", "controller" => [new EmailController(), 'sendEmail'], "method" => "POST"],

    // Other routes
    ["name" => "css", "url" => "/main.css", "controller" => [new FrontendController(), 'style'], "method" => "GET"],
    ["name" => "js", "url" => "/main.js", "controller" => [new FrontendController(), 'javascript'], "method" => "GET"],
    ["name" => "images", "url" => "/images/{slug}", "controller" => [new FrontendController(), 'images'], "method" => "GET"],
];

$generatedRoute = new RouteManager($routes);
return $generatedRoute->getGeneratedRoutes();

