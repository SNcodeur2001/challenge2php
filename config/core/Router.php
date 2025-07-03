<?php

namespace App\Config\Core;

class Router
{
    public static array $routes = [];

    public static function resolve()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (array_key_exists($uri, self::$routes)) {
            $controllerName = self::$routes[$uri]['controller'];
            $actionName = self::$routes[$uri]['action'];
            if (class_exists($controllerName) && method_exists($controllerName, $actionName)) {
                $controller = new $controllerName();
                return $controller->$actionName();
            } else {
                $controllerErreur = new \App\Controller\ErrorController();
                $controllerErreur->notFound();
            }
        }

        // Route par défaut
        $controller = new \App\Controller\CommandeController();
        $controller->index();
    }
}