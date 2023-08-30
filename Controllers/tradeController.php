<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\tradeModel;


class tradeController extends Controller
{

    public function openTrade(){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        if (!$data){
            http_response_code(400);
            echo json_encode(array("error" => "no data"));
            return;
        } else {
        $quantity = $data['quantity'];
        $id = $data['profile_id'];
        $price = $data['price'];
        $symbol = $data['symbol'];
        $trade = new tradeModel();
        $trade->trade($quantity, $symbol, $id, $price);


        }
        

    }
}

?>