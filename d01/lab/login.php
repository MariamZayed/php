<?php
    //  var_dump($_REQUEST);
    //  var_dump($_POST);

    // if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $lang = $_POST['lang'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        var_dump($gender);
        $fullname = $fname.$lname;

        echo "<h3> Please checkout ypur inforamtion: </h3>";
        if($gender=="female")
            echo "Hello Ms: {$fullname}<br>";
        else
            echo "Hello Mr: {$fullname}<br>";

        echo "Address: {$address}<br>";
        echo "Your Skills: <br>";
        foreach ($lang as $k=>$value){
            echo "{$value}<br>";
        }
    // }    
?>