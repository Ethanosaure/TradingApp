<?php

namespace App\Routes;

use Bramus\Router\Router;
use App\Controllers\HomeController;
use App\Controllers\signUpController;
use App\Controllers\loginController;
use App\Controllers\testController;

$router = new Router();

$router->get('/', function() {
    (new HomeController)->index();
});
$router->get('/api', function(){
 (new HomeController)->api();
});
$router->get('/signUp', function(){
    (new signUpController)->index();
});
$router->get('/Login', function(){
    (new loginController)->index();
});
$router->get('/test', function(){
    (new testController)->testConnection();
});
$router->run();