<?php
    include '../layouts/general.php';

    $userID = $_GET['id'];
    $updatedUserRecord= $userID."|";


    if(!file_exists("../usersDB.txt"))
        header("location:../View/usersTable.php?file DB doesn't exists!");
    else
        $usersArr = file("../usersDB.txt");
        
    if(isset($_POST['submit'])) {

        foreach($usersArr as $index=>$user){
            $userInfo= explode('|', $user);
            if ($userInfo[0]==$userID){          
                if($_POST['name']){
                    $name = $_POST['name'];
                    $updatedUserRecord =$updatedUserRecord.$name."|";
                }
                else
                    $updatedUserRecord =$updatedUserRecord.$userInfo[1]."|";
                if($_POST['email']){
                    $email = $_POST['email'];
                    $updatedUserRecord =$updatedUserRecord.$email."|";
                }
                else
                    $updatedUserRecord =$updatedUserRecord.$userInfo[2]."|";
                if($_POST['password']){
                    $password = $_POST['password'];
                    $updatedUserRecord =$updatedUserRecord.$password."|";
                }
                else
                    $updatedUserRecord =$updatedUserRecord.$userInfo[3]."|";
                if($_POST['roomNO']){
                    $roomNO = $_POST['roomNO'];
                    $updatedUserRecord =$updatedUserRecord.$roomNO."|";
                }
                else
                    $updatedUserRecord =$updatedUserRecord.$userInfo[4]."|";
                if(isset($_POST['image'])){
                    $image = $_POST['image'];
                    $updatedUserRecord =$updatedUserRecord.$image."|";
                }
                else
                    $updatedUserRecord =$updatedUserRecord.$userInfo[5];

                array_push($usersArr,$updatedUserRecord);
                unset($usersArr[$index]);
                    file_put_contents("../usersDB.txt", implode("", $usersArr));
                    echo 'file updated successfully';
                break;
            
            }
            
        }
    
    }
///    exit;
?>