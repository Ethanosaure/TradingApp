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
$router->get('/api/trades/index/open', function (){
    (new tradeController)->tradeOpen();
});
$router->get('/api/trades/index/closed', function(){
    (new tradeController)->tradeClosed();
});
$router->get("/api/trades/{id}", function($id){
    (new tradeController)->getOneTrade($id);
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
$router->post('/api/closeTrade/{id}', function($id){
    (new tradeController)->closeTrade($id);
});

// PATCH
$router->patch('/api/update', function(){
     (new loginController)->updateProfile();
});
$router->run();