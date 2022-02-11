<?php

use App\Http\Controller\Admin\AdminLocationsController;
use App\Http\Controller\Admin\AdminMainController;
use App\Http\Controller\Admin\AdminPerformerController;
use App\Http\Controller\Admin\AdminRestaurantController;
use App\Http\Controller\Admin\AdminRolesController;
use App\Http\Controller\Admin\AdminUsersController;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\EventController;
use App\Http\Controller\FrontendController;
use Matrix\Managers\RouteManager;

$routes = [
    ["name" => "login", "url" => "/login", "controller" => [new LoginController(), 'index'], "method" => "GET"],
    ["name" => "login_post", "url" => "/login", "controller" => [new LoginController(), 'login'], "method" => "POST"],
    ["name" => "admin", "url" => "/admin", "controller" => [new AdminMainController(), 'index'], "method" => "GET"],
    ["name" => "admin_performers", "url" => "/admin/performers", "controller" => [new AdminPerformerController(), 'index'], "method" => "GET"],
    ["name" => "admin_locations", "url" => "/admin/locations", "controller" => [new AdminLocationsController(), 'index'], "method" => "GET"],
    ["name" => "admin_restaurants", "url" => "/admin/restaurants", "controller" => [new AdminRestaurantController(), 'index'], "method" => "GET"],
    ["name" => "admin_roles", "url" => "/admin/roles", "controller" => [new AdminRolesController(), 'index'], "method" => "GET"],
    ["name" => "admin_users", "url" => "/admin/users", "controller" => [new AdminUsersController(), 'index'], "method" => "GET"],
    //@TODO make a controller for this and make sure this works 100% and not half or some shit!
    ["name" => "css", "url" => "/main.css", "controller" => [new FrontendController(), 'style'], "method" => "GET"],
    ["name" => "js", "url" => "/main.js", "controller" => [new FrontendController(), 'javascript'], "method" => "GET"],
    ["name" => "test", "url" => "/event/{title}", "controller" => [new EventController(), "index"], "method" => "GET"],
];

$generatedRoute = new RouteManager($routes);
return $generatedRoute->getGeneratedRoutes();

