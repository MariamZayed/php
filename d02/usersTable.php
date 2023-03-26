<?php
include './layouts/general.php';

// --------- Start of DB
try{
   // Show data in table
    if(is_readable("usersDB.txt")){            
        $user_reacords = file("usersDB.txt");
        $user_reacords=array_filter($user_reacords);
        echo "<table class='table'>
        <tr><th> ID</th><th> Fullname</th> <th> Address </th><th> Gender </th> </tr>";
        foreach($user_reacords as $user){
            $user = trim($user,"\n");
            $userArray = explode("|",$user);
            echo "<tr>";   
            foreach($userArray as $data){
                echo "<td> {$data} </td>";
            }
            $deleteUrl="deleteUser.php?id={$userArray[0]}";
            echo "<td> <a href='"."{$deleteUrl}". "' class='btn btn-danger'> Delete</a> </td>";
            $editUrl="editForm.php?id={$userArray[0]}";
            echo "<td> <a href='"."{$editUrl}". "' class='btn btn-primary'> Edit</a> </td>";
            echo "</tr>";
        }
    }
}catch (Exception $e) {var_dump($e);}
// ---------- End of DB
?>