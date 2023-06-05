<?php

require "connection.php";
$conn = connection();


session_start();


if(isset($_POST['login'])){
    $un = $_POST['username'];
    $pass = $_POST['password'];

    $sql="SELECT * FROM accounts WHERE username = '$un' AND pass = '$pass'";
    $result = $conn->query($sql);
    $rows = $result->fetch_assoc();
    $data = $result->num_rows;

    if($data > 0){
        $_SESSION['id'] = $rows['user_id']; 
        $_SESSION['user_name'] = $rows['user_full_name'];
        header("location: index.php");
    } else { ?>
        <script>
            alert("invalid account!");
        </script>
    <?php }

}


// if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
//     $session_id=$_SESSION['id'];
//     $sql = "SELECT * FROM accounts WHERE user_id = '$session_id'";
//     $result = $conn->query($sql);
//     $user_rows = $result->fetch_array();

//     header("location: index.php" .$session_id);
// } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <!-- <button id="register">Register Account?</button><br><br> -->
    <a href="create.php">Create Account?</a><br><br>
    <div class="login-container">
        <div class="login">
            <h1>Login</h1>
            <form action="" method="post">
                <Label>Username:</Label>
                <input type="text" name="username" id="username" placeholder="Enter your username" required><br><br>
                <Label>Password:</Label>
                <input type="password" name="password" id="pass" placeholder="Enter your password" required><br><br>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>