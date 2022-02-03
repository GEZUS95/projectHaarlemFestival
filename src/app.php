<?php

use Http\Controller\LeapYearController;
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' =>  [new LeapYearController(), 'index'],
]));

return $routes;
