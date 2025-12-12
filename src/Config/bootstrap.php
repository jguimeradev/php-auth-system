<?php

require_once __DIR__ . '/../../vendor/autoload.php';


#dotenv path. Immutable does not allow to change $_ENV values
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

$debug = filter_var($_ENV['APP_DEBUG'], FILTER_VALIDATE_BOOL);

if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}
