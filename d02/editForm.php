<?php
    if($_GET){
        $errors = json_decode($_GET['errors']);
        $errors = (array) $errors;
    }
?>

<!DOCTYPE html>
<html skills="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Form </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">

        <form method="post" action="editUser.php" >
            <div class="mb-3">
                <label  class="form-label">First Name</label>
                <input type="text" name='fname' class="form-control">
            </div>         
            <div class="mb-3">
                <label  class="form-label">last name</label>
                <input type="text" name='lname' class="form-control">
            </div>
            
            <div class="mb-3">
                <label  class="form-label">Address</label>
                <textarea name='address' class="form-control"></textarea>
            </div>

            <label  class="form-label">Skills:</label>
            <div class="mb-3 form-check">
                <input type="checkbox" name="skills[]"  value="MYSQL" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label"  for="exampleCheck1">MYSQL</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="skills[]"  value="js" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label"  for="exampleCheck1">js</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="skills[]"  value="nodejs" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label"  for="exampleCheck1">nodejs</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="skills[]"  value="php" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label"  for="exampleCheck1">php</label>
            </div>

            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label><br>   

            <div class="mb-3">
                <label  class="form-label">username:</label>
                <input type="text" name='username' class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>