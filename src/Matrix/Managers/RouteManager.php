<?php

namespace Matrix\Managers;

use App\Http\Controller\Admin\AdminMainController;
use App\Http\Controller\Auth\LoginController;
use App\Http\Controller\LeapYearController;
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

        if($params != array()){
            //@TODO loop to $params and add them to the route before returning
            return "/";
        }

        foreach (self::$routeList as $r) {
            if ($r["name"] == $name)
                return "http://" .$_SERVER['SERVER_NAME'].$r["url"];
        }

        throw new ResourceNotFoundException("Routes not found");

    }
}
