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
    public function trade($quantity, $name, $id){
        $API = new ApiSite();
        $result = $API->ApiGet();
        if ($result){
            $data = json_decode($result, true);
            if ($data){
                foreach($data as $ent){
                    if ($ent['name'] = $name){
                     var_dump($ent);
                    }else {
                        return `no society called $name`;
                    }
                }
                
            } else {
                echo 'Error';
            }
        } else {
            http_response_code(500);
            echo json_encode(array('error' => 'no response from API'));
            return;
        }
    }
}

?>