<?php
    include './layouts/general.php';


    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $skills = $_POST['skills'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    $fullname = $fname.$lname;
    $user_record = "{$fullname}|{$address}|{$gender}";
    $errors =[];
    $formFields =array("fname"=>$fname,"lname"=>$lname,"address"=>$address,"skills"
        =>$skills,"username"=>$username,"password"=>$password,"gender"=>$gender);
    $formCorrectFields= [];

    

    //----------- Start of Validation
    foreach ($formFields as $key=> $filed){
        if(!isset($filed) or empty($filed)){
            $errors[$key] = "{$key} is Required <br>";
        }else
            $formCorrectFields[$key] =$filed;
    }
    if($errors){
        $jsonErrors=json_encode($errors);
        $redirectURL = "Location:loginForm.php?errors={$jsonErrors}";
        // passing written fields to url so user not have to write again
        if($formCorrectFields){
            $oldValues=json_encode($formCorrectFields);
            $redirectURL.="&oldValues={$oldValues}";
        }
        header($redirectURL);
    }else{
        // ------ Start Create ID for User
        $date = date_create();// if no errors from validation then create an id
        $userID = date_timestamp_get($date);
        $user_record = "{$userID}|{$fullname}|{$address}|{$gender}";
        // ------ End Create ID for User

        header("location:usersTable.php");

    }
    // //----------- End of Validation
?>      
