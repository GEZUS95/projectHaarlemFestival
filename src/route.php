<?php

use App\Http\Controller\Admin\AdminEventController;
use App\Http\Controller\Admin\AdminLocationsController;
use App\Http\Controller\Admin\AdminMainController;
use App\Http\Controller\Admin\AdminPerformerController;
use App\Http\Controller\Admin\AdminProgramController;
use App\Http\Controller\Admin\AdminRestaurantController;
use App\Http\Controller\Admin\AdminRolesController;
use App\Http\Controller\Admin\AdminUsersController;
use App\Http\Controller\HomeController;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\Auth\RegisterController;
use App\Http\Controller\EventController;
use App\Http\Controller\FoodController;
use App\Http\Controller\FrontendController;
use App\Http\Controller\TestEmailController;
use Matrix\Managers\RouteManager;

$routes = [
    // basic routes
    ["name" => "home", "url" => "/", "controller" => [new HomeController(), 'index'], "method" => "GET"],
    ["name" => "login", "url" => "/login", "controller" => [new LoginController(), 'index'], "method" => "GET"],
    ["name" => "login_post", "url" => "/login", "controller" => [new LoginController(), 'login'], "method" => "POST"],
    ["name" => "register", "url" => "/register", "controller" => [new RegisterController(), 'index'], "method" => "GET"],
    ["name" => "register_post", "url" => "/register", "controller" => [new RegisterController(), 'register'], "method" => "POST"],
    
    // Food routes
    ["name" => "food", "url" => "/food", "controller" => [new FoodController(), 'index'], "method" => "GET"],

    // Admin routes
    ["name" => "admin", "url" => "/admin", "controller" => [new AdminMainController(), 'index'], "method" => "GET"],
    ["name" => "admin_performers", "url" => "/admin/performers", "controller" => [new AdminPerformerController(), 'index'], "method" => "GET"],

    ["name" => "admin_locations", "url" => "/admin/locations", "controller" => [new AdminLocationsController(), 'index'], "method" => "GET"],
    ["name" => "admin_locations_paginator", "url" => "/admin/location/{page}/{amount}", "controller" => [new AdminLocationsController(), 'show'], "method" => "GET"],

    ["name" => "admin_restaurants", "url" => "/admin/restaurants", "controller" => [new AdminRestaurantController(), 'index'], "method" => "GET"],
    ["name" => "admin_roles", "url" => "/admin/roles", "controller" => [new AdminRolesController(), 'index'], "method" => "GET"],
    ["name" => "admin_users", "url" => "/admin/users", "controller" => [new AdminUsersController(), 'index'], "method" => "GET"],
    ["name" => "admin_event", "url" => "/admin/event/{title}", "controller" => [new AdminEventController(), 'index'], "method" => "GET"],
    ["name" => "admin_event_edit", "url" => "/admin/event/{title}/edit", "controller" => [new AdminEventController(), 'edit'], "method" => "GET"],

    ["name" => "admin_event_titles", "url" => "/admin/get/event/titles", "controller" => [new AdminMainController(), "getEventTitles"], "method" => "GET"],
    ["name" => "admin_event_overview", "url" => "/admin/event/{title}/json", "controller" => [new AdminEventController(), 'overview'], "method" => "POST"],
    ["name" => "admin_program_create", "url" => "/admin/program/create", "controller" => [new AdminProgramController(), 'create'], "method" => "POST"],

    // Test routes
    ["name" => "test", "url" => "/event/{title}", "controller" => [new EventController(), "index"], "method" => "GET"],

    ["name" => "test_email", "url" => "/emailtest", "controller" => [new TestEmailController(), 'index'], "method" => "GET"],
    ["name" => "test_email_post", "url" => "/emailtest", "controller" => [new TestEmailController(), 'sendEmail'], "method" => "POST"],

    // Other routes
    ["name" => "css", "url" => "/main.css", "controller" => [new FrontendController(), 'style'], "method" => "GET"],
    ["name" => "js", "url" => "/main.js", "controller" => [new FrontendController(), 'javascript'], "method" => "GET"],
];

$generatedRoute = new RouteManager($routes);
return $generatedRoute->getGeneratedRoutes();

