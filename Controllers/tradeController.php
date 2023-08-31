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
    public function getTrades(){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        if (!$data){
            http_response_code(400);
            echo json_encode(array('Error' => 'no data'));
            return;
        } else {
            $id = $data['profile_id'];
            $tradeIndex = new tradeModel();
            $tradeIndex->tradeIndex($id);
        }
    }
    public function getOneTrade($id){
        $oneTrade = new tradeModel();
        $oneTrade->GetOneTrade($id);
    }
    public function tradeOpen(){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        if(!$data){
            echo json_encode(array('Error' => 'No data'));
            return;
        } else {
        $id = $data['profile_id'];
        $trade = new tradeModel();
        $trade->TradeOpen($id);
        }
    }
    public function tradeClosed(){
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true);
    if(!$data){
        echo json_encode(array('Error' => "No data"));
        return;
    } else {
        $id = $data['profile_id'];
        $closedTrade = new tradeModel();
        $closedTrade->TradeClosed($id);
        }
    }
    public function closeTrade($id){
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        if(!$data){
            echo json_encode(array('Error' => 'No Data'));
            return;
        } else {
            $profileId = $data['profile_id'];
            $price = $data['close_price'];
            $trade = new tradeModel();
            $trade->CloseTrade($id, $profileId, $price);
        }
    }
    public function tradeClosePNL(){
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        if(!$data){
            echo json_encode(array('Error'=>'no data'));
            return;
        } else {
            $profileId = $data['profile_id'];
            $trade = new tradeModel();
            $trade->calculClosePNL($profileId);
        }
    }
}

?>