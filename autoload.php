<?php

/**
 * autoload files
 */
spl_autoload_register(function ($className) {
    $className = str_replace(['\\', 'FileManager'], ['/', ''], $className);
    $className = ltrim($className, '/');

    require_once $className . '.php';
});