<?php
    include '../layouts/general.php';
    require_once('./dbConection.php');
?>  

<!DOCTYPE html>
<html skills="en">
<head>
    <meta charset="UTF-8">
    <title>Register form </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <a href="homePage.php">Home</a>
        <a href="#">Products</a>
        <a href="usersTable.php">Users</a>
        <a href="#">Checks</a>

        <form method="post" action="../Controller/editUser.php?id=<?php echo $old[0]; ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label  class="form-label">Name</label>
                <input type="text" name='name' class="form-control" value="<?php echo $old[1]; ?>">
            </div>         
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" name='email' value="<?php echo $old[2]; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Repeat Password</label>
                <input type="password" name="repeatPassword" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Room No</label>
                <input type="text" name="roomNO" class="form-control" value="<?php echo $old[4]; ?>" id="exampleInputPassword1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            </div>
            <div class="mb-3">
                <label>Profile Picture</label>
                <input type="file" name="image"/>
            </div>
                
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </form>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
