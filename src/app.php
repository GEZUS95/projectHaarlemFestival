<?php

use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\LeapYearController;
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    '_controller' =>  [new LeapYearController(), 'index'],
], [], [], '', [],['GET']));

$routes->add('leap_year_json', new Routing\Route('/is_leap_year_json/{year}', [
    '_controller' =>  [new LeapYearController(), 'jsonTest'],
]));

$routes->add('login', new Routing\Route('/login', [
    '_controller' =>  [new LoginController(), 'index'],
], [], [], '', [],['GET']));


$routes->add('login_post', new Routing\Route('/login', [
    '_controller' =>  [new LoginController(), 'login'],
], [], [], '', [],['POST']));
return $routes;

