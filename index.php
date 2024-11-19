<?php

declare(strict_types=1);

function my_error_handler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        return;
    }
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
ini_set('display_errors', true);
set_error_handler("my_error_handler");

session_start();

require './vendor/autoload.php';

require './config.php';

require ABSPATH . './connectDB.php';

require ABSPATH . './bootstrap.php';

require ABSPATH . './routes/web.php';

if (isset($match['target']) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    echo 'Error 404 not found';
    exit;
}
