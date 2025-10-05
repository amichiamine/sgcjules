<?php

namespace App\Core;

/**
 * Router Class
 *
 * This class is responsible for routing incoming requests to the appropriate
 * controller. It reads the routes from a configuration file and matches
t * he current request's URI and method to a defined route.
 */
class Router
{
    /**
     * @var array The routes loaded from the configuration file.
     */
    protected $routes = [];

    /**
     * Router constructor.
     *
     * Loads the routes from the `config/routes.json` file.
     */
    public function __construct()
    {
        $routesPath = ROOT_PATH . '/config/routes.json';
        if (file_exists($routesPath)) {
            $this->routes = json_decode(file_get_contents($routesPath), true);
        }
    }

    /**
     * Dispatches the request to the appropriate handler.
     *
     * @param string $uri The requested URI.
     * @param string $method The request method (e.g., 'GET', 'POST').
     */
    public function dispatch($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['path'] === $uri && $route['method'] === $method) {
                $handler = $route['handler'];
                if (class_exists($handler)) {
                    $controller = new $handler();
                    // Assuming a 'render' method exists on the view controller
                    if (method_exists($controller, 'render')) {
                        $controller->render();
                        return;
                    }
                }
            }
        }

        // If no route is found, display a 404 error
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
        exit;
    }
}