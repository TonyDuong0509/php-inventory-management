<?php

require_once './vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('ABSPATH', __DIR__ . '/');

define('SERVER_NAME', $_ENV['SERVERNAME']);
define('USERNAME', $_ENV['USERNAME']);
define('PASSWORD', $_ENV['PASSWORD']);
define('DBNAME', $_ENV['DBNAME']);
