<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\testModel;

class testController extends Controller
{
    public function testConnection(){
        $testmodel = new testModel();
        $testmodel->connection();
        if ($testmodel->connection() ===  true){
            $data = ['name' => 'OK'];
            return $this->view('test', $data);
        } else {
            $data = ['name' => 'Nope'];
            return $this->view('test', $data);
        }
}



}



?>