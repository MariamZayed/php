<?php
    session_start();
    if(empty($_SESSION))
        header("location:./registerForm.php? you should login!");
    else
        echo "<h1> Cafetria </h1>";
?>
    <a href="./editForm.php" class="btn btn-danger">Edit users</a><br>
    <a href="../Controller/logout.php" class="btn btn-danger">Logout </a>

