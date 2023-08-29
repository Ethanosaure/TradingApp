<?php
namespace App\Models;

use App\Core\connect;
use App\Controllers\tradeController;
use App\Models\ApiSite;

class tradeModel{
    private $bdd;

    public function __construct(){
        $this->bdd = connect::getConnect();
    }
    public function trade($quantity, $name){
        $API = new ApiSite();
        $result = $API->ApiGet();
        if ($result){
            echo $result;
        } else {
            http_response_code(500);
            echo json_encode(array('error' => 'no response from API'));
            return;
        }
    }
}

?>