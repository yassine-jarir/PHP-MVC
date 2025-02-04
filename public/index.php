<?php

require_once '../vendor/autoload.php';
 

use App\Core\Router;

$router = new Router();

 
require_once "../app/Config/routes.php";
use App\Config\routes;
 
$router->dispatch();
