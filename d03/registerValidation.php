<?php   // here goes validation
        include "./helper/imageExtension.php";
        include "./helper/addUser.php";
        include './layouts/general.php';

    session_start();
    $_SESSION["name"]= 'mariam';      
    if(!empty($_SESSION))
        header("location:index.php? go to home page");
    var_dump( $_SESSION);


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

    echo "post:";
    var_dump($_POST);
    //----------- Start of Validation -------------
    foreach ($formCurrentFields as $key=> $filed){
        if(!isset($filed) or empty($filed)){
            $errors[$key] = "{$key} is Required <br>";
        }else
            $formVaildFields[$key] =$filed;
    }
    
    // check for repeating password
    if($password!=$repeatPassword)
        header("location:registerForm.php?error= password isn't same");
    // Check image extensions 
    imageValidation($errors,$fileName);
    if($errors){
        $jsonErrors=json_encode($errors);
        $redirectURL = "Location:registerForm.php?errors={$jsonErrors}";
        var_dump($errors);
        if($formVaildFields){// passing written fields to url so user not have to write again
            $oldValues=json_encode($formVaildFields);
            $redirectURL.="&oldValues={$oldValues}";
        }
        header($redirectURL);
    }else{
        echo"testii<br>";   
        if($fileError!==0)
            echo "there was an error uploading your file";
        else{
            echo"testooo<br>";
            if($fileSize>1000000)
                echo "file exedded valid size";
            else{
                echo "testING";
                $splitImage = explode(".",basename($fileName));// indexes are iamge name and etension
                $extension = end($splitImage); // bring the last index =>extension
                $imageNewName = uniqid('',true).".".$extension;
                $imagePath = "./images/{$imageNewName}";

                if(!move_uploaded_file($fileTmp,$imagePath))
                    echo " something went wrong while uploading image";
                else{
                    // Create ID for User
                    $date = date_create();// if no errors from validation then create an id
                    $userID = date_timestamp_get($date);
                    $userRecord = "{$userID}|{$name}|{$email}|{$password}|{$roomNO}|{$imagePath}";
                    echo "testwwww";
                    try{
                        echo "testoo";
                        $fileHandler= fopen("usersDB.txt", 'a');
                        fwrite($fileHandler, $userRecord.PHP_EOL);
                        fclose($fileHandler);

                        if(is_readable('usersDB.txt')){
                            $users= file("usersDB.txt");
                        }

                    }
                    catch (Exception $e){
                        var_dump($e);
                    }
                    // header("location:registerValidation.php?upload-success");
                }   
            }
        }
    }
    //----------- End of Validation ------------


?>