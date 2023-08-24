<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ApiSite;

class HomeController extends Controller
{
    /*
    * return view
    */
    public function index()
    {
        return $this->view('welcome',[]);
    }
    public function api(){
        $API = new ApiSite();
        $API->ApiGet();
    }
}