<?php
namespace App\Core;


use PDO;


class connect
{
    private static $bdd;

    public static function getConnect()
    {
    try {
         include 'config.php';
            $bdd = new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', ''.$username.'', ''.$password.'');
            return $bdd;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>