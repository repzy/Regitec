<?php

namespace Regitec;

use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$environment = 'production';

/*
 * Error block
 */
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Friendly error page and send an email to the developer';
    });
}
$whoops->register();

/*
 * Http block
 */
$request = Request::createFromGlobals();

$router = new Router();
$routes = $router->getRoutes();

$app = new Core($routes);

$app->handle($request);
