<?php
    //  var_dump($_REQUEST);
    //  var_dump($_POST);
    // if(isset($_POST['submit'])){
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $lang = $_POST['lang'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $fullname = $fname.$lname;
        $user_record = "{$fullname}:{$address}:{$gender}";
        

        try{
             // Write in db
            $fileHandler=fopen("usersDB.txt",'a');
            fwrite($fileHandler, $user_record.PHP_EOL);
            fclose($fileHandler);
    
            // Show data in table
            if(is_readable("usersDB.txt")){            
                $user_reacords = file("usersDB.txt");
                echo "<table class='table'>
                <tr> <th> Fullname</th> <th> Address </th><th> Gender </th> </tr>";
                foreach($user_reacords as $user){
                    $user = trim($user,"\n");
                    $user_arr = explode(":",$user);
                    echo "<tr>";   
                    foreach($user_arr as $data){
                        echo "<td> {$data} </td>";
                    }
                    echo "</tr>";
                }
            }
    
        }catch (Exception $e){
            var_dump($e);
        }

        if(true){
            echo "<h3> Please checkout your inforamtion: </h3>";
            if($gender=="female")
                echo "Hello Ms: {$fullname}<br>";
            else
                echo "Hello Mr: {$fullname}<br>";
    
            echo "Address: {$address}<br>";
            echo "Your Skills: <br>";
            foreach ($lang as $k=>$value){
                echo "{$value}<br>";
            } 
        }

?>