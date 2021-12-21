<?php

//display errors mainly for debug mode
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//include autoload
require_once 'autoload.php';

//include helpers
require_once 'helper.php';

\FileManager\Helper::startApplication();

//include routes
require_once 'routes.php';