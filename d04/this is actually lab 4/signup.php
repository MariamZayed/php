<?php
include '../layouts/general.php';

require_once('./dbConection.php');

// validate data
$errors = [];

if (isset($_POST['submit'])) {
    $date = date_create();
    $id = date_timestamp_get($date);
    if ($_POST["name"]) {
        $name = $_POST["name"];
    } else 
        $errors["name"] = "Name is Required";
    if ($_POST["email"]) {
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST["email"];
        } else
            $errors["email"] = "Email is Invalid";
    }
    else 
        $errors["email"] = "Email is Required";
    if ($_POST["password"]) {
        //bonus
        $pattern = "/^[a-z_]{8}$/";
        if (preg_match($pattern, $_POST["password"])) {
            $password = $_POST["password"];
        } 
        else 
            $errors["password"] = "Invalid password, only valid 8 lowercase chars & unerscore _";
    } else 
        $errors["password"] = "Password is Required";
    if ($_POST["repeatPassword"]) {
        $confirm_Pass = $_POST["repeatPassword"];
        if ($confirm_Pass != $password) 
            $errors["repeatPassword"] = "password isn't matched";
    } else 
        $errors["repeatPassword"] = "repeatPassword is Required";

    if ($_POST["roomNO"] != "") {
        $roomNO = $_POST["roomNO"];
    } else {
        $errors["roomNO"] = "roomNO is Required";
    }


    if ($_FILES["image"]) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        $extension = explode('.', basename($file_name));
        $allowed_extenstions = ["png", 'jpg', 'jpeg'];

        if (in_array(end($extension), $allowed_extenstions)) {
            $res = move_uploaded_file($file_tmp, "images/{$file_name}");

            $imagePath = "images/{$file_name}";
        } else {
            $errors["image"] = "Upload image is Invalid extenstion";
        }
    } else {
        $errors["image"] = "Upload image is Required";
    }

    $formerrors = urlencode(json_encode($errors));

    if ($errors) {
        var_dump($formerrors);
        $redirect_url = "Location:./signupForm.php?errors={$formerrors}";
        if ($formvalues) {
            $oldvalues = json_encode($formvalues);
            $redirect_url .= "&old={$oldvalues}";
        }

        header($redirect_url);
    }
    if (!$errors) {
        $db = new DB();
        $db_user = "root";
        $db_pass = "";
        $db_name = "cafeteria";
        $db->connect($db_user,$db_pass,$db_name);
        $sql = "insert INTO `users` (`name`, `email`, `password`,`roomNO`,`imagePath`) VALUES(:name,:email,:password,:roomNO,:imagePath)";
        // Bind the parameters to the prepared statement
        $stmt = $db->conn->prepare($sql);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":roomNO", $roomNO);
        $stmt->bindParam(":imagePath", $imagePath);

        // Execute the statement
        $result = $stmt->execute();

        if($result){

            header("location:./usersTable.php");
            die();
        }
        else {
            // Statement execution failed, handle the error
            $errorInfo = $stmtinsert->errorInfo();
            $errorMessage = $errorInfo[2];
        
            // You can log the error, display an error message, or handle it in any other way
            echo "Error: " . $errorMessage;
        }
    } 
}
