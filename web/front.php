<?php
require_once dirname(__DIR__, 1)."/Boot.php";

use Matrix\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing;

//Load routes into the application
$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/route.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Framework($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();
