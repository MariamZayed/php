<?php
    include '../layouts/general.php';

    $userID = $_GET['id'];
    echo $userID;
    if(!file_exists("../usersDB.txt"))
        header("location:../View/usersTable.php?file DB doesn't exists!");
    else
        $usersArr = file("../usersDB.txt");
        
    foreach($usersArr as $index=>$user){
        $userInfo= explode('|', $user);
        if ($userInfo[0]==$userID){
            unset($usersArr[$index]);
            break;
        }
    }
    
    $fileHandler = fopen("../usersDB.txt", 'w');
    foreach ($usersArr as $user){
        fwrite($fileHandler, $user);
    }
    fclose($fileHandler);
    readfile('../usersDB.txt');
    // header('location:../View/usersTable.php');
    exit;
?>