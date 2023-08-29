<?php
namespace App\Models;


use App\Core\connect;
use App\Controllers\loginController;


class loginModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = connect::getConnect();
    }
    public function log($email, $password)
    {
        $request= 'SELECT id, password FROM user WHERE email = :email';
        $stmt = $this->bdd->prepare($request);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$userData || !password_verify($password, $userData['password'])){
            return false;
        }
        $profileQuery = 'SELECT * FROM profile WHERE user_id = :user_id';
        $profilestmt = $this->bdd->prepare($profileQuery);
        $profilestmt->bindParam(':user_id', $userData['id']);
        $profilestmt->execute();

        $profileData = $profilestmt->fetch(\PDO::FETCH_ASSOC);
        return $profileData;
    }

    public function getProfileInfo($id){
        $request = 'SELECT * FROM profile WHERE id = :id';
        $statement = $this->bdd->prepare($request);
        $statement->bindParam(':id', $id);
        $result = $statement->execute();

        if ($result){
            $profileData = $statement->fetch(\PDO::FETCH_ASSOC);
            return $profileData;
        }
        else {
            
            return null;
        }
        
    }
    public function update($name, $lastName, $address, $id){
        $rqst = 'SELECT * FROM profile WHERE id = :id';
        $stmt = $this->bdd->prepare($rqst);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
            if ($result === false){
                http_response_code(404);
                return;
            }  else{
               $row = $stmt->rowCount();
               if ($row === 0) {
                http_response_code(404);
                echo json_encode(array('error' => "this id doesn't exist"));
                return;
               } else if ($row === 1){
                $profileData = $stmt->fetch(\PDO::FETCH_ASSOC);
                $Name = (($profileData['first_name'] != $name) && ($name != null)) ? $name : $profileData['first_name'];
                $LastName = (($profileData['last_name'] != $lastName) && ($lastname != null)) ? $lastName : $profileData['last_name'];
                $Address = (($profileData['address'] != $address) && ($address != null)) ? $address : $profileData['address'];

                $request = 'UPDATE profile SET first_name = :firstName, last_name = :lastName, address = :address WHERE id = :id';
                $statement = $this->bdd->prepare($request);
                $statement->bindParam(':firstName', $Name);
                $statement->bindParam(':lastName', $LastName);
                $statement->bindParam(':address', $Address);
                $statement->bindParam(':id', $id);
                $statement->execute();
                return true;
                } 
                
            }
    
}
}

?>