<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\loginModel;

class LoginController extends Controller{
    public function index(){
        return $this->view('login', []);
    }
    
    public function login(){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
         if ($data === null){
            http_response_code(400);
            echo json_encode(array("error" => "Invalid JSON data"));
            return;
        } 

        if (isset($data['email']) && isset($data["password"])){
        $email = $data['email'];
        $password = $data['password'];
        $logModel = new loginModel();
        $result = $logModel->log($email, $password);

            if ($result === false){
            http_response_code(400);
            echo json_encode(array("error" => "This user doesn't exist"));
            exit();
            } else {
            echo json_encode(array("success" => true, "profileData" => $result));
            return;
            }
        } else {
            http_response_code(400);
            echo json_encode(array("error" => "Please enter your information"));
            return;
        }

    }
}