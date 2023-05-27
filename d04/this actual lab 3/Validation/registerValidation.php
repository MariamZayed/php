<?php   // here goes validation
        // include "./imageExtValidation.php";
        include "../Controller/addUser.php";
        include '../layouts/general.php';

    session_start();



    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    $roomNO = $_POST['roomNO'];
    $fileName = $_FILES['image']['name'];
    $fileSize =$_FILES['image']['size'];
    $fileType=$_FILES['image']['type'];
    $fileTmp =$_FILES['image']['tmp_name'];
    $fileError =$_FILES['image']['error'];

    $errors =[];
    $formVaildFields= [];
    $formCurrentFields =array("name"=>$name,"email" =>$email,"password"=>$password,
    "repeatPassword"=>$repeatPassword,"roomNO"=>$roomNO,"fileName"=>$fileName);

    // echo "post:";
    // var_dump($_POST);
    //----------- Start of Validation -------------
    foreach ($formCurrentFields as $key=> $filed){
        if(!isset($filed) or empty($filed)){
            $errors[$key] = "{$key} is Required <br>";
        }else
            $formVaildFields[$key] =$filed;
    }
    
    // check for repeating password
    if($password!=$repeatPassword)
        header("location:../Views/registerForm.php?error= password isn't same");
    // Check image extensions 
    // imageValidation($errors,$fileName);
    if($errors){
        $jsonErrors=json_encode($errors);
        $redirectURL = "Location:../Views/registerForm.php?errors={$jsonErrors}";
        if($formVaildFields){// passing written fields to url so user not have to write again
            $oldValues=json_encode($formVaildFields);
            $redirectURL.="&oldValues={$oldValues}";
        }
        header($redirectURL);
    }else{
        // echo"testii<br>";   
        if($fileError!==0)
            echo "there was an error uploading your file";
        else{
            // echo"testooo<br>";
            if($fileSize>1000000)
                echo "file exedded valid size";
            else{
                // echo "testING";
                $splitImage = explode(".",basename($fileName));// indexes are iamge name and etension
                $extension = end($splitImage); // bring the last index =>extension
                $imageNewName = uniqid('',true).".".$extension;
                $imagePath = "../images/{$imageNewName}";

                if(!move_uploaded_file($fileTmp,$imagePath))
                    echo " something went wrong while uploading image";
                else{
                    // Create ID for User
                    $date = date_create();// if no errors from validation then create an id
                    $userID = date_timestamp_get($date);
                    $userRecord = "{$userID}|{$name}|{$email}|{$password}|{$roomNO}|{$imagePath}";
                    // echo "testwwww";
                    addUser($userRecord);
                    $_SESSION["name"]= $name;      
                    header("location:../View/homePage.php");
                }   
            }
        }
    }
    //----------- End of Validation ------------


?>