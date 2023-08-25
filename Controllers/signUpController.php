<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\signUpModel;

class signUpController extends Controller
{
    public function index(){
        return $this->view('signUp', []);
    }
    public function signUp(){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        
        if ($data === null){
            http_response_code(400);
            exit();
        } 
        if(isset($data['email']) && isset($data['name']) && isset($data['lastname']) && isset($data['password']) && isset($data['passwordsecond']) && isset($data['address'])) {
        $email = $data['email'];
        $name = $data['name'];
        $password = $data['password'];
        $passwordSecond = $data['passwordsecond'];
        $lastname = $data['lastname'];
        $address = $data['address'];
            if ($password === $passwordSecond){
           $signUpUser = new signUpModel();
           $passwords = password_hash($password, PASSWORD_DEFAULT);
           $signUpUser->signUP($email, $passwords, $name, $lastname, $address);

            } else {
                http_response_code(400);
                echo 'passwords are not the same';
                exit();
            }
        } else {
        http_response_code(400);
        echo 'Please fill in all the inputs';
        exit();
        }
}
}


?>