<?php

// Define a constant for the root path of the project
define('ROOT_PATH', __DIR__);

// Define a constant for the base URL of the project
// This makes the application portable, as it dynamically determines the base URL.
$baseURL = sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\')
);
define('BASE_URL', $baseURL);

// Include the PSR-4 autoloader
require_once ROOT_PATH . '/Core/Autoloader.php';

// Register the autoloader
App\Core\Autoloader::register();

// Create an instance of the application
$app = new App\Core\Application();

// Run the application to handle the request
$app->run();