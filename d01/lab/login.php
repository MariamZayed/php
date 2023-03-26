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
        $fullname = $fname.$lname;

        // --------- Start of Welcoming msg
        if(true){
            echo "<h3> Please checkout your inforamtion: </h3>";
            if($gender=="female")
                echo "Hello Ms: {$fullname}<br>";
            else
                echo "Hello Mr: {$fullname}<br>";
    
            echo "Address: {$address}<br>";
            echo "Your Skills: <br>";
            foreach ($skills as $k=>$value){
                echo "{$value}<br>";
            } 
        }
        // --------- End of Welcoming msg
    // }    
?>