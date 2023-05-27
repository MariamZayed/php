<?php
include '../layouts/general.php';
require_once('./dbConection.php');

    $id = $_GET['id'];
    $db = new DB();
    $db_user = "root";
    $db_pass = "";
    $db_name = "cafeteria";
    $db->connect($db_user,$db_pass,$db_name);
    $query = 'SELECT * FROM `cafeteria`.`users` WHERE id=:id;';
    $stmt = $db->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $result = $stmt->execute();
    if ($result) {
        $user = $stmt->fetchObject();
    }
    // validate data
    $errors = [];
    $formvalues = [];
    $name;
    $email;
    $password;
    $repeatPassword;
    $roomNO;
    if (isset($_POST['submit'])) {

        if ($_POST["name"]) 
            $name = $_POST["name"];
        if ($_POST["email"]) {
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST["email"];
            } 
            else 
                $errors["email"] = "Email is Invalid";
        } 
        if (!empty($_POST["password"])) {
            //bonus
            $pattern = "/^[a-z_]{8}$/";
            if (preg_match($pattern, $_POST["password"])) {
                $password = $_POST["password"];
            } 
            else 
                $errors["password"] = "Invalid password, should be only 8 lowercase letters & only (_) allowed";
        }
        else{
            // var_dump($user->password);
            $password = $user->password;
        }
        if ($_POST["repeatPassword"]) {
            $repeatPassword = $_POST["repeatPassword"];
            if ($repeatPassword != $password) {
                $errors["repeatPassword"] = "password isn't matched";
            }
        }       
        if ($_POST["roomNO"] != "") 
            $roomNO = $_POST["roomNO"];
            var_dump($roomNO);
        $formerrors = urlencode(json_encode($errors));
        if ($errors) {
            $redirect_url = "Location:edit.php?errors={$formerrors}";
            if ($formvalues) {
                $oldvalues = json_encode($formvalues);
                $redirect_url .= "&old={$oldvalues}";
            }
            header($redirect_url);
        }
        if (!$errors) {
            try {
            

                $query = "UPDATE `users`
                SET `name` =:name , `email`=:email, `password`=:password, `roomNo`=:roomNO
                WHERE `id`=:id; ";
                $stmt = $db->conn->prepare($query);

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $password);
                $stmt->bindParam(":roomNO", $roomNO);
                $stmt->bindParam(":id", $id);
                var_dump([$id,$name,$email,$password,$roomNO]);

                $query_execute = $stmt->execute();
                if($query_execute)
                    header("location:usersTable.php? user updated");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>

<!DOCTYPE html>
<html skills="en">
<head>
    <meta charset="UTF-8">
    <title>Register form </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <a href="homePage.php">Home</a>
        <a href="#">Products</a>
        <a href="usersTable.php">Users</a>
        <a href="#">Checks</a>

        <form method="post" action="edit.php?id=<?= $user->id?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label  class="form-label">Name</label>
                <input type="text" name='name' class="form-control" value="<?php echo $user->name; ?>">
            </div>         
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" name='email' value="<?php echo $user->email; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Repeat Password</label>
                <input type="password" name="repeatPassword" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Room No</label>
                <input type="text" name="roomNO" class="form-control" value="<?php echo $user->roomNo; ?>" id="exampleInputPassword1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            </div>
            <div class="mb-3">
                <label>Profile Picture</label>
                <input type="file" name="image"/>
            </div>
                
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </form>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
