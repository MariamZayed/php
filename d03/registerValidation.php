<?php
// here goes validation

    include "./helper/imageExtension.php";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    $roomNO = $_POST['roomNO'];
    $file_name = $_FILES['image']['name'];
    $fileSize =$_FILES['image']['size'];
    $fileType=$_FILES['image']['type'];
    $fileTmp =$_FILES['image']['tmp_name'];
    $fileError =$_FILES['image']['error'];

    $errors =[];
    $formVaildFields= [];
    $formCurrentFields =array("name"=>$name,"email" =>$email,"password"=>$password,"repeatPassword"=>$repeatPassword,"roomNO"=>$roomNO,);//"file_name"=>$file_name


    //----------- Start of Validation -------------
    foreach ($formCurrentFields as $key=> $filed){
        if(!isset($filed) or empty($filed)){
            $errors[$key] = "{$key} is Required <br>";
        }else
            $formVaildFields[$key] =$filed;
    }
    // check for repeating password
    if($password!=$repeatPassword)
        header("location:registerForm.php?error= password isnt same");
    // Check image extensions 
    // imageValidation($errors,$file_name);
    if($errors){
        $jsonErrors=json_encode($errors);
        $redirectURL = "Location:registerForm.php?errors={$jsonErrors}";
        if($formVaildFields){// passing written fields to url so user not have to write again
            $oldValues=json_encode($formVaildFields);
            $redirectURL.="&oldValues={$oldValues}";
        }
        header($redirectURL);
    }else{
        // echo"testii";
        if($fileError!==0)
            echo "there was an error uploading your file";
        else{
            // echo"testooo";
            if($fileSize>1000000)
                echo "file exedded valid size";
            else{
                echo "testING";
                $splitImage = explode(".",basename($file_name));// indexes are iamge name and etension
                $extension = end($splitImage); // bring the last index =>extension
                $imageNewName = uniqid('',true).".".$extension;
                $imagePath = "./images/{$imageNewName}";
                // $res = move_uploaded_file($fileTmp,$imagePath);
                // var_dump($res);
                if(!move_uploaded_file($fileTmp,$imagePath))
                    echo " something went wrong while uploading image";
                else{
                    // Create ID for User
                    $date = date_create();// if no errors from validation then create an id
                    $userID = date_timestamp_get($date);
                    $user_record = "{$userID}|{$name}|{$email}|{$password}|{$roomNO}|{$imagePath}";
                    header("location:registerValidation.php?upload-success");
                }   
                

            }


            

            // header("location:usersTable.php");
        }
        

    }

    //----------- End of Validation ------------


?>