<?php

use App\Http\Controller\Admin\AdminMainController;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\LeapYearController;
use Matrix\Managers\RouteManager;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

$routes = [
    ["name" => "leap_year", "url" => "/is_leap_year/{year}", "controller" => [new LeapYearController(), 'index'], "method" => "GET"],
    ["name" => "leap_year_json", "url" => "/is_leap_year_json/{year}", "controller" => [new LeapYearController(), 'jsonTest'], "method" => "GET"],
    ["name" => "login", "url" => "/login", "controller" => [new LoginController(), 'index'], "method" => "GET"],
    ["name" => "login_post", "url" => "/login", "controller" => [new LoginController(), 'login'], "method" => "POST"],
    ["name" => "admin", "url" => "/admin", "controller" => [new AdminMainController(), 'index'], "method" => "GET"],
    ["name" => "css", "url" => "/main.css", "controller" => function () {
        $file = '../public/main.css';
        $response = new BinaryFileResponse($file);
        $response->setPublic();
        $response->setMaxAge(1);
        $response->headers->set('Content-Type', 'text/css');
        return $response;
    }, "method" => "GET"],
    ["name" => "js", "url" => "/main.js", "controller" => function () {
        $file = '../public/main.js';
        $response = new BinaryFileResponse($file);
        $response->setPublic();
        $response->setMaxAge(1);
        $response->headers->set('Content-Type', 'text/javascript');
        return $response;
    }, "method" => "GET"],
];


$generatedRoute = new RouteManager($routes);
return $generatedRoute->getGeneratedRoutes();

