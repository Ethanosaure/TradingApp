<?php
namespace App\Models;

use App\Core\connect;
use App\Controllers\wireController;
use PDO;


class wireModel {

    private $bdd;

    public function __construct(){
        $this->bdd = connect::getConnect();
    }

    public function Wire($profileId, $amount, $withdrawal) {
    $rqst = 'SELECT balance FROM profile WHERE id = :profileId';
    $statement = $this->bdd->prepare($rqst);
    $statement->bindParam(':profileId', $profileId);
    $statement->execute();
    $balance = $statement->fetchColumn();

    if ($withdrawal === false) {
        $finalBalance = $amount + $balance;
        $request = 'UPDATE profile SET balance = :finalBalance WHERE id = :profileId';
        $stmt = $this->bdd->prepare($request);
        $stmt->bindParam(':profileId', $profileId);
        $stmt->bindParam(':finalBalance', $finalBalance);
        $stmt->execute();
        $this->WireUpdate($profileId, $amount, $withdrawal);
        echo "The deposit has been made";
        return;
    } else if ($withdrawal === true && $balance >= $amount) {
        $finalBalance = $balance - $amount;
        $request = 'UPDATE profile SET balance = :finalBalance WHERE id = :profileId';
        $stmt = $this->bdd->prepare($request);
        $stmt->bindParam(':profileId', $profileId);
        $stmt->bindParam(':finalBalance', $finalBalance);
        $stmt->execute();
        $this->WireUpdate($profileId, $amount, $withdrawal);
        echo 'The withdrawal has been made';
        return;
    } else if ($withdrawal === true && $balance < $amount) {
        echo "insufficient funds";
        return;
    }
}

public function WireUpdate($profileId, $amount, $withdrawal) {
    $request = 'INSERT INTO wire (profile_id, amount, withdrawal) VALUES (:profileId, :amount, :withdrawal)';
    $stmt = $this->bdd->prepare($request);
    $stmt->bindParam(':profileId', $profileId);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':withdrawal', $withdrawal, PDO::PARAM_BOOL);
    $stmt->execute();
}
}

?>