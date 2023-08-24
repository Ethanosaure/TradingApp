<?php
namespace App\Controllers;

use App\Core\Controller;

class signUpController extends Controller
{
    public function index(){
        return $this->view('signUp', []);
    }
}



?>