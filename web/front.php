<?php
require_once __DIR__.'/../vendor/autoload.php';

use Matrix\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing;

$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory(__DIR__ . '/src');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

//Load routes into the application
$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

//Load capsule into the application
include dirname(__DIR__, 1)."/src/Config/Connection.php";

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Framework($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();
