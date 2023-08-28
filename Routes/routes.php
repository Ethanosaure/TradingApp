<?php

namespace App\Routes;

use Bramus\Router\Router;
use App\Controllers\signUpController;
use App\Controllers\loginController;
use App\Controllers\wireController;

$router = new Router();


// GET
$router->get('/api/login', function(){
 (new loginController)->login();
});


// POST 
$router->post('/api/wire', function (){
    (new wireController)->makeWire();
});
$router->post('/api/signUp', function(){
    (new signUpController)->signUp();
});
$router->run();