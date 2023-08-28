<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\wireModel;

class wireController extends Controller{

    public function makeWire(){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
         if ($data === null){
            http_response_code(400);
            echo json_encode(array("error" => "Invalid JSON data"));
            return;
        } 
        if (isset($data['profile_id']) && isset($data['amount']) && isset($data['withdrawal'])){
            $profileId = $data['profile_id'];
            $amount = $data['amount'];
            $withdrawal = $data['withdrawal'];

            $wire = new wireModel();
            $result = $wire->Wire($profileId, $amount, $withdrawal);
        } else {
            http_response_code(400);
            echo json_encode(array("error" => "Please enter your information"));
            return;
        }



    }
}



?>
