<?php
namespace App\Models;

use App\Core\connect;
use App\Controllers\tradeController;

class tradeModel {
    private $bdd;

    public function __construct() {
        $this->bdd = connect::getConnect();
    }

    public function trade($quantity, $symbol, $id, $price) {
        $request = "SELECT balance FROM profile WHERE id = :id";
        $statement = $this->bdd->prepare($request);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($result === false){
            echo json_encode(array('Error' => "Profile with id: $id doesn't exist"));
        } else {
        $balance = $result['balance'];

        $toPay = $price * $quantity;
        if ($toPay <= $balance){
            $finalBalance = $balance - $toPay;
            $rqst = 'INSERT INTO trade (profile_id, symbol, quantity, open_price, close_price, open_datetime) VALUES (:profile_id, :symbol, :quantity, :open_price, 0, now())';
            $stmt = $this->bdd->prepare($rqst);
            $stmt->bindParam(':profile_id', $id);
            $stmt->bindParam(':symbol', $symbol);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':open_price', $price);
            $result = $stmt->execute();

            if($result){
                $request = 'UPDATE profile SET balance = :balance WHERE id = :id';
                $statement = $this->bdd->prepare($request);
                $statement->bindParam(':id', $id);
                $statement->bindParam(':balance', $finalBalance);
                $statement->execute();
                echo json_encode(array('success' => 'Trade successfully acquired'));
            } else {
                echo json_encode(array('Error' => 'An error occured'));
            }
        } else {
            echo 'insufficient funds';
        }
    } 
    }
}
?>