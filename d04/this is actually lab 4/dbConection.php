<?php

$db_user = "root";
$db_pass = "";
$db_name = "cafeteria";
class DB{
    public $conn;
    function connect($db_user,$db_pass,$db_name){
        try{

            $this->conn = new PDO('mysql:host=localhost;dbname='.$db_name.";",$db_user,$db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                echo "Connected successfully!";
            } catch(PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
            
    }    



}


?>