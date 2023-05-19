<?php

require "connection.php";
$conn = connection();

if(isset($_POST['delete'])){

    $id = $_POST['row-delete'];

    $sql = "DELETE FROM test_code_db WHERE id = '$id'";
    $conn->query($sql);

    header("location: index.php");

}


?>