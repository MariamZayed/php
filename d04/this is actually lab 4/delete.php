<?php
include '../layouts/general.php';
require_once('./dbConection.php');


    $id = $_GET['id'];
    $db = new DB();
    $db_user = "root";
    $db_pass = "";
    $db_name = "cafeteria";
    $db->connect($db_user,$db_pass,$db_name);

    try {
        $query = "DELETE FROM `users` WHERE id=:id";
        $stmt = $db->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $result = $stmt->execute();
        if($result){
            header("Location:usersTable.php");
        }
        else{
            echo "wrong statement";
        }
    } catch(PDOException $e){
        echo $e->getMessage();
    }


?>