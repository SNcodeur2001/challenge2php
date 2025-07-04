<?php

namespace App\Config\Core;

class Router
{
    private static array $routes = [];

    public static function get(string $uri, string $controller, string $action): void
    {
        self::$routes['GET'][$uri] = ['controller' => $controller, 'action' => $action];
    }

    public static function post(string $uri, string $controller, string $action): void
    {
        self::$routes['POST'][$uri] = ['controller' => $controller, 'action' => $action];
    }

    public static function resolve(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Vérifier si l'utilisateur est connecté (sauf pour les routes de connexion)
        session_start();
        $publicRoutes = ['/', '/login', '/authenticate'];
        
        if (!in_array($uri, $publicRoutes) && !isset($_SESSION['user_logged'])) {
            header('Location: /login');
            exit;
        }

        // Si pas de route spécifiée, rediriger vers la connexion
        if ($uri === '/') {
            if (isset($_SESSION['user_logged'])) {
                header('Location: /list');
                exit;
            } else {
                $uri = '/login';
            }
        }

        if (isset(self::$routes[$method][$uri])) {
            $route = self::$routes[$method][$uri];
            $controllerName = $route['controller'];
            $action = $route['action'];

            $controller = new $controllerName();
            $controller->$action();
        } else {
            // 404 - Route non trouvée
            http_response_code(404);
            require_once __DIR__ . '/../../template/commande/404.php';
        }
    }
}