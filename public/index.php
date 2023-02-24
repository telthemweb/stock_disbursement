<?php
/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| to this client's browser, allowing them to enjoy our application.
|
*/

require __DIR__ . './../dispatcher/Dispatcher.php';
ini_set('session.gc_maxlifetime', 1800) ;
session_start();
$app = new Dispatcher();
$app->run();
