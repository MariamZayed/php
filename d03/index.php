<?php
    session_start();
    if(empty($_SESSION))
        header("location:registerForm.php? you should login!");
    else
        echo "<h1> Cafetria </h1>";
?>
    echo <a href="./helper/logout.php" class="btn btn-danger">Logout </a>;
