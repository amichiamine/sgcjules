<?php

namespace App\Core;

/**
 * PSR-4 Autoloader
 *
 * This autoloader allows us to load classes automatically without needing
 * to include them manually. It follows the PSR-4 standard for autoloading.
 */
class Autoloader
{
    /**
     * Registers the autoloader with the SPL autoloader stack.
     */
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * Autoloads a class.
     *
     * @param string $class The fully-qualified class name.
     */
    public static function autoload($class)
    {
        // Project-specific namespace prefix
        $prefix = 'App\\';

        // Base directory for the namespace prefix
        $base_dir = ROOT_PATH . '/';

        // Does the class use the namespace prefix?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // No, move to the next registered autoloader
            return;
        }

        // Get the relative class name
        $relative_class = substr($class, $len);

        // Replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // If the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }
}