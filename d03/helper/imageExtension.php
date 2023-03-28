<?php
    function imageValidation($errors,$file_name){
        $splitImage = explode(".",basename($file_name));// indexes are iamge name and etension
        $extension = end($splitImage); // bring the last index =>extension
        $allowedExtension = ["png", 'jpg', 'jpeg'];
        if(!in_array($extension, $allowed_extenstions)){
            $errors["file_name"] = "select image of png, jpg, jpeg<br>";
        }
    }
?>