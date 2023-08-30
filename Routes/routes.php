<?php

namespace App\Routes;

use Bramus\Router\Router;
use App\Controllers\signUpController;
use App\Controllers\loginController;
use App\Controllers\wireController;
use App\Controllers\tradeController;

$router = new Router();


// GET
$router->get('/api/login', function(){
 (new loginController)->login();
});
$router->get('/api/profile', function(){
 (new loginController)->getProfile();
});
$router->get('/api/trades/index', function(){
    (new tradeController)->getTrades();
});


// POST 
$router->post('/api/wire', function (){
    (new wireController)->makeWire();
});
$router->post('/api/signUp', function(){
    (new signUpController)->signUp();
});
$router->post('/api/openTrade', function(){
    (new tradeController)->openTrade();
});

// PATCH
$router->patch('/api/update', function(){
     (new loginController)->updateProfile();
});
$router->run();