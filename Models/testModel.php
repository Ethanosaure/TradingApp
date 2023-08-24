<?php
namespace App\Models;

use App\Core\connect;

class testModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = connect::getConnect();
    }
    public function connection(){
        $request = 'SELECT * FROM profile';
        $statement = $this->bdd->prepare($request);
        $statement->execute();
        if ($statement){
            return true;
        }
        else {
            return false;
        }
    }
}


?>