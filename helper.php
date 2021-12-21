<?php

namespace FileManager;

class Helper
{
    /**
     * Indicator for url matching
     *
     * @var bool
     */
    public static $URL_MATCHED = false;

    /**
     * Initialize application
     */
    public static function startApplication(): void
    {
        session_start();

        if(!isset($_SESSION['fileStoragePath']) || empty($_SESSION['fileStoragePath'])) {
            $_SESSION['fileStoragePath'] = uniqid();
        }
    }

    /**
     * Execute controller action
     *
     * @param  string  $pathToMatch
     * @param  string  $className
     * @param  string  $action
     * @return mixed
     */
    public static function route(string $pathToMatch, string $className, string $action = 'index'): mixed
    {
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];
        if (!static::$URL_MATCHED && $path === $pathToMatch) {
            static::$URL_MATCHED = true;
            $obj = new $className();

            return $obj->$action();
        }

        return 0;
    }

    /**
     * Redirect to give path
     *
     * @param  string  $path
     */
    public static function redirect(string $path): void
    {
        header('Location: /'.trim($path, '/'));
        die;
    }

    /**
     * Create variables from params and includes view file
     *
     * @param  string  $fileName
     * @param  array  $params
     * @return mixed
     */
    public static function view(string $fileName, array $params = []): void
    {
        foreach ($params as $key => $param) {
            ${$key} = $param;
        }

        require_once 'Views/'.$fileName.'.php';
    }

    /**
     * Print errors
     *
     * @param $key
     * @return string
     */
    public static function printErrors($key): string
    {
        if(isset($_SESSION['errors']) && isset($_SESSION['errors'][$key])){
            $message = array_shift($_SESSION['errors'][$key]);
            unset($_SESSION['errors']);

            return $message;
        }

        return '';
    }
}
