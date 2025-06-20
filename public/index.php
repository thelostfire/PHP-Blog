<?php

use App\Core\Router;
use App\Routes;
use Dotenv\Dotenv;

require __DIR__."/../vendor/autoload.php";
$dotenv = Dotenv::createImmutable('..');
$dotenv->load();

$router = new Router(Routes::defineRoutes());
$router->init();