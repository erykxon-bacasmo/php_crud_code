<?php

require "connection.php";
$conn = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM test_code_db WHERE id = '$id'";
$result = $conn->query($sql);
$rows = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <h1>Hello Mr. <?php echo $rows['full_name']?></h1>
    <a href="index.php">Back</a>
</body>
</html>