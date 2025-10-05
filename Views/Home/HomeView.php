<?php

namespace App\Views\Home;

/**
 * View Controller for the Home Page
 *
 * This class is responsible for rendering the home page. It finds the
 * corresponding HTML template and displays it.
 */
class HomeView
{
    /**
     * Renders the home page view.
     *
     * This method includes the HTML template for the home page, which will
     * be sent to the browser.
     */
    public function render()
    {
        // Path to the HTML template
        $templatePath = __DIR__ . '/home.html';

        if (file_exists($templatePath)) {
            include $templatePath;
        } else {
            // In a real application, this should be a more robust error handling
            header("HTTP/1.0 500 Internal Server Error");
            echo 'Error: Template file not found.';
            exit;
        }
    }
}