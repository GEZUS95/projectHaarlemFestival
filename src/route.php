<?php

use App\Http\Controller\Admin\AdminMainController;
use App\Http\Controller\Auth\LoginController;
use Matrix\Managers\RouteManager;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

$routes = [
    ["name" => "login", "url" => "/login", "controller" => [new LoginController(), 'index'], "method" => "GET"],
    ["name" => "login_post", "url" => "/login", "controller" => [new LoginController(), 'login'], "method" => "POST"],
    ["name" => "admin", "url" => "/admin", "controller" => [new AdminMainController(), 'index'], "method" => "GET"],
    //@TODO make a controller for this and make sure this works 100% and not half or some shit!
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

