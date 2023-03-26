<?php
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $skills = $_POST['skills'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $fullname = $fname.$lname;
        $user_record = "{$fullname}:{$address}:{$gender}";
        $errors =[];
        $formFields =array("fname"=>$fname,"lname"=>$lname,"address"=>$address,"skills"
            =>$skills,"username"=>$username,"password"=>$password,"gender"=>$gender);
        $formCorrectFields= [];

        //-----------Start of Validation
        foreach ($formFields as $key=> $filed){
            if(!isset($filed) or empty($filed)){
                $errors[$key] = "{$key} is Required <br>";
                // var_dump($errors[$key]);
            }else
                $formCorrectFields[$key] =$filed;
        }
        if($errors){
            $jsonErrors=json_encode($errors);
            $redirectURL = "Location:loginHTML.php?errors={$jsonErrors}";
            // passing written fields to url so user not have to write again
            if($formCorrectFields){
                $oldValues=json_encode($formCorrectFields);
                $redirectURL.="&oldValues={$oldValues}";
            }
            header($redirectURL);
        }
        //----------- End of Validation


        //-------------- Start of DB    
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
        }catch (Exception $e) {var_dump($e);}
        //-------------- End of DB
        

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
//  var_dump($_REQUEST);
    //  var_dump($_POST);
    // if(isset($_POST['submit'])){}
        // for($i=0;$i<sizeof($formFields);$i++){
        //     if(!isset($test) or empty($test)){
        //         $errors[$test] = "{$test} is Required <br>";
        //         // array_push($errors,"{$$formFields[$i]}");
        //         // var_dump (errors[$i]);
        //         // var_dump($$formFields[$i]);
        //     }  
        // }
        // if(!isset($fname)or empty($fname) and !isset($lname)or empty($lname) 
        //     and !isset($address)or empty($address) and !isset($skills)or empty($skills)
        //     and !isset($username)or empty($username) 
        //     and !isset($gender)or empty($gender)){
        //     $error["First Name"] = "First Name is Required"
        // }else{

        // }
?>
