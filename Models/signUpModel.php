<?php
namespace App\Models;

use App\Core\connect;
use App\Controllers\signUpController;

class signUpModel
{
    private $bdd;


    public function __construct()
    {
        $this->bdd = connect::getConnect();
    }
    public function signUP($email, $passwords, $name, $lastname, $address){
            $request = 'INSERT INTO user (email, password) VALUES (:email, :password)';
            $stmt = $this->bdd->prepare($request);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwords);
            if ($stmt->execute()){
            $lastInsertID= $this->bdd->lastInsertId();
            $request2 = 'INSERT INTO profile (user_id, first_name, last_name, address) VALUES (:lastInsert, :name, :lastname, :address)';
            $statement = $this->bdd->prepare($request2);

            $statement->bindParam(':lastInsert', $lastInsertID);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':lastname', $lastname);
            $statement->bindParam(':address', $address);
            if($statement->execute()){
                echo 'User and Profile inserted successfully';
            } else {
                echo 'Error inserting Profile: ' . $statement->errorInfo()[2];
            }
            } else {
                echo 'Error inserting User: '.$stmt->errorInfo()[2];
            }
    }
}

?>