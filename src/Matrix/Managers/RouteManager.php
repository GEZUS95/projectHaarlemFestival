<?php

namespace Matrix\Managers;

use Symfony\Component\Routing;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class RouteManager
{

    private Routing\RouteCollection $generatedRoutes;
    private static array $routeList;

    public function __construct($routes)
    {
        self::$routeList = $routes;
        $this->generatedRoutes = new Routing\RouteCollection();

        foreach ($routes as $route) {
            $this->generatedRoutes->add($route["name"], new Routing\Route($route["url"], [
                '_controller' => $route["controller"],
            ], [], [], '', [], [$route["method"]]));
        }
    }

    public function getGeneratedRoutes(): Routing\RouteCollection
    {
        return $this->generatedRoutes;
    }

    public static function getUrlByRouteName($name, $params = array()): string
    {
        if (self::$routeList == null) {
            throw new ResourceNotFoundException("Routes are not set");
        }

        if ($params != array()) {
            $generatedRoute = self::getUrl($name);

            if ($generatedRoute == null)
                throw new ResourceNotFoundException("Route not found");

            foreach ($params as $param) {
                foreach (explode("/", $generatedRoute) as $url) {
                    if (!empty($url) && $url[0] == '{' && $url[strlen($url) - 1] == '}' && $params[substr($url, 1, -1)] == $param) {
                        $generatedRoute = str_replace($url, $param, $generatedRoute);
                    }
                }
            }
            return "http://" . $_SERVER['SERVER_NAME'] . $generatedRoute;
        }


        foreach (self::$routeList as $r) {
            if ($r["name"] == $name)
                return "http://" . $_SERVER['SERVER_NAME'] . $r["url"];
        }

        throw new ResourceNotFoundException("Route not found");

    }

    public static function getUrlWithOutFilledParameters($name): string
    {
        return "http://" . $_SERVER['SERVER_NAME'] . self::getUrl($name);
    }

    private static function getUrl($name)
    {
        foreach (self::$routeList as $r) {
            if ($r["name"] == $name)
                return $r["url"];
        }
        return null;
    }
}
