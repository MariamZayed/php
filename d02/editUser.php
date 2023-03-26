<?php

$errors = [];
if ($_GET) {
    $errors = json_decode($_GET['errors'], true);
}

if(isset($_POST["submit"])){
    if(!$_GET['id'])
        echo "there's no id for this user!";
    else{
        var_dump($_GET['id']);
    }

}
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     echo $_POST['id'];
//     $allowed = ["id", "fname", "lname", "address", "country", "gender", "skills", "username", "password", "dept"];
//     $errors = [];
//     $_POST = array_intersect_key($_POST, array_flip($allowed));
//     var_dump($_POST);
//     foreach ($allowed as $key) {
//         if (!isset($_POST[$key])) {
//             $errors[$key] = $key . " is required";
//         } else {
//             if ($key == "fname" && empty($_POST[$key]))
//                 $errors[$key] = "First Name is required";
//             elseif ($key == "lname" && empty($_POST[$key]))
//                 $errors[$key] = "Last Name is required";
//             elseif ($key == "gender" &&  !in_array($_POST['gender'], ["male", "female"]))
//                 $errors[$key] = "Please Choose Your Gender";
//             elseif ($key == "address" && empty($_POST[$key]))
//                 $errors[$key] = "Address Is Required";
//             elseif ($key == "password" && empty($_POST[$key]))
//                 $errors[$key] = "Password is required";
//             elseif ($key == "skills" && empty($_POST[$key]) &&  !in_array($_POST['skills'], ["mysql", "php", "post", "java"]))
//                 $errors[$key] = "Please Choose One Skill Ate Least";
//             elseif ($key == "username" && empty($_POST[$key]))
//                 $errors[$key] = "Username is required";
//             elseif ($key == "country" && !in_array($_POST['country'], ["cairo", "mansoura", "damietta"]))
//                 $errors[$key] = "Please Choose Your Country";
//         }
//     }
//     if ($errors) {
//         header("Location:edit.php?id={$_POST['id']}&errors=" . json_encode($errors));
//     } else {
//         $users = file("usersDB.txt");
//         $skills = implode(",", $_POST['skills']);
//         foreach ($users as $key => $user) {
//             if (explode(":", $user)[0] == $_POST['id']) {
//                 //                unset($users[$key]);
//                 echo $key;
//                 echo $users[$key];
//                 $users[$key] = "{$_POST['id']}:{$_POST['fname']}:{$_POST['lname']}:{$_POST['address']}:{$_POST['country']}:{$_POST['gender']}:{$skills}:{$_POST['username']}:{$_POST['password']}:{$_POST['dept']}\n";
//                 break;
//             }
//         }
//         file_put_contents("usersDB.txt", implode("", $users));
//         header("Location:login.php");
//     }
//     exit;
// }



// $user = [];
// if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET["id"]) {
//     $id = $_GET['id'];
//     //        echo $id."<br>";
//     $users = file("usersDB.txt");
//     $users = array_filter($users, function ($user) use ($id) {
//         $user = explode(":", $user);
//         return $user[0] == $id;
//     });
//     foreach ($users as $user) {
//         $user = explode(":", trim($user));
//         $user[6] = explode(",", $user[6]);
//         break;
//     }
//     if (!$user) {
//         header("location:login.php");
//         exit;
//     }
// }
?>

