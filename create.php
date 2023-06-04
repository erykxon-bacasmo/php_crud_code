<?php

require "connection.php";
$conn = connection();



if(isset($_POST['create'])){
    $un = $_POST['un'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $name = $_POST['fname'];

    if(!empty($_POST["pass"]) && ($_POST["pass"] !== $_POST["cpass"])){

        echo "<script>alert('Your password did not match! Please try again');</script>";
    } else if(($_POST["pass"] == $_POST["cpass"])){
        echo "<script>alert('Create Successfully!');</script>";
        $sql = "INSERT INTO accounts (`username`, `pass`, `user_full_name`) VALUES('$un', '$pass', '$name')";
        $conn->query($sql);
        // header("location: login.php");

    } else {
        // $sql = "INSERT INTO accounts (`username`, `pass`, `user_full_name`) VALUES('$un', '$pass', '$name')";
        // $conn->query($sql);
        // header("location: login.php");
        return;
    }
}

// } else if($pass == $cpass){
//     echo "password match!"; 
//     header("location: login.php");
// } else{
//     echo "password did not match!";
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <h1>Create Account</h1><br><br>
    <form action="" method="post">
        <Label>Username</Label>
        <input type="text" name="un" required><br><br>
        <Label>Password</Label>
        <input type="password" name="pass" id="pass" required><br><br>
        <Label>Confirm Password</Label>
        <input type="password" name="cpass" id="cpass" required><br><br>
        <Label>Full Name</Label>
        <input type="text" name="fname" required><br><br>
        <button type="submit" name="create">Create</button>
        <a href="login.php">Cancel</a>
    </form>
</body>
</html>