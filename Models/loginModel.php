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
           return $statement->fetch(\PDO::FETCH_ASSOC);
            
        }
        else {
            echo "Error, Profile doesn't exist";
            return;
        }
        
    }
}



?>