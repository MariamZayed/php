<?php
echo "<div class='container fs-5' >  ";
session_start();
if(isset($_SESSION)){
    $_SESSION = array();
    session_destroy();
    setcookie('PHPSESSID', '', time()-3600, '/', '', 0);
}
?>
<h1>You logout Succesfully!</h1>
<a href="../View/registerForm.php">Login Page</a> -->