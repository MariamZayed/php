<?php

$db_user = "root";
$db_pass = "";
$db_name = "cafeteria";

$db = new PDO('mysql:host=localhost;dbname='.$db_name.";",$db_user,$db_pass);

?>