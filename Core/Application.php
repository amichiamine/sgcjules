<?php

namespace App\Core;

/**
 * Main Application Class
 *
 * This class is the entry point of the application. It handles the
 * request, dispatches it to the appropriate router, and runs the application.
 */
class Application
{
    /**
     * Runs the application.
     *
     * This method is the main entry point for handling a web request.
     * It instantiates the router and dispatches the current request.
     */
    public function run()
    {
        // Get the requested URI and method
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // Remove the base path from the URI to make it clean
        $basePath = dirname($_SERVER['SCRIPT_NAME']);
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // If the URI is empty, default to the root path
        if (empty($uri)) {
            $uri = '/';
        }

        // Dispatch the request using the router
        $router = new Router();
        $router->dispatch($uri, $method);
    }
}