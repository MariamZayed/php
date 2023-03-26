<?php
    include './layouts/general.php';

    $userID = $_GET['id'];
    if(!file_exists("usersDB.txt"))
        echo"Something went wrong, file DB doesn't exists!";
    else
        $users = file("usersDB.txt");
        
    foreach ($users as $index=>$user){
        $userInfo= explode('|', $user);
        var_dump($userInfo);  
        if ($userInfo[0]==$userID){
            unset($users[$index]);
            break;
        }
    }
    
    $fileHandler = fopen("usersDB.txt", 'w');
    foreach ($users as $user){
        fwrite($fileHandler, $user);
    }
    fclose($fileHandler);
    readfile('usersDB.txt');
    header('Location:usersTable.php');
    exit;
?>