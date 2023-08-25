<?php

namespace App\Routes;

use Bramus\Router\Router;
use App\Controllers\signUpController;
use App\Controllers\loginController;

$router = new Router();

$router->get('/api/login', function(){
 (new loginController)->login();
});


$router->post('/api/signUp', function(){
    (new signUpController)->signUp();
});
$router->run();