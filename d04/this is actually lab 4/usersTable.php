<?php
include '../layouts/general.php';
require_once('./dbConection.php');


    $users;
    $db = new DB();
    $db_user = "root";
    $db_pass = "";
    $db_name = "cafeteria";
    $db->connect($db_user,$db_pass,$db_name);
    
    $query = 'SELECT * FROM `cafeteria`.`users`;';
    $stmt = $db->conn->prepare($query);
    $result = $stmt->execute();

    if ($result) {
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

    }



// --------- Start of DB
try{
        echo "<table class='table'>
        <tr><th> ID</th><th> Fullname</th> <th> email </th><th> roomNO </th><th> image </th> </tr>";
        foreach($users as $user){   
            // var_dump($user->roomNo);
            echo "<tr>";   
                echo "<td> {$user->id} </td>";
                echo "<td> {$user->name} </td>";
                echo "<td> {$user->email} </td>";
                echo "<td> {$user->roomNo} </td>";
                echo "<td><img src='{$user->imagePath}' width='50px' height='50px'></td>";

            $deleteUrl="./delete.php?id={$user->id}";
            echo "<td> <a href='"."{$deleteUrl}". "' class='btn btn-danger'> Delete</a> </td>";
            $editUrl="./edit.php?id={$user->id}";
            echo "<td> <a href='"."{$editUrl}". "' class='btn btn-primary'> Edit</a> </td>";
            echo "</tr>";
        }
    
}catch (Exception $e) {var_dump($e);}
// ---------- End of DB


?>
