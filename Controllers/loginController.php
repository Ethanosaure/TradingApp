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
    public function getProfile(){
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        if ($data === null){
            http_response_code(400);
            echo json_encode(array("error" => "Invalid JSON data"));
            return;
        } else {
            $id = $data['profile_id'];
            $profile = new loginModel();
            $result  = $profile->getProfileInfo($id);

            if ($result){
                http_response_code(200);
                echo json_encode(array($result));
                return;
            } else {
                http_response_code(404);
                echo json_encode(array("error" => "Profile doesn't exist"));
                return;
            }
        }
        
    }
    public function updateProfile(){
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        if ($data === null){
            http_response_code(400);
            echo json_encode(array("error" => "No JSON data"));
            return;
        } else if(!isset($data['id'])){
            http_response_code(400);
            echo json_encode(array("error" => "No ID"));
            return;
        }else{
            $name = isset($data['first_name']) ? $data['first_name'] : null;
            $lastName = isset($data['last_name']) ? $data['last_name']: null;
            $address = isset($data['address']) ? $data['address'] : null;
            $id = $data['id'];
            $logModel = new loginModel();
            $result = $logModel->update($name, $lastName, $address, $id);
            if ($result === true){
                http_response_code(200);
                echo json_encode(array('Success' => 'your profile has been updated'));
                return;
            } else {
                echo json_encode(array('error' => 'an error occured'));
                return;
            }
        }
    }
}