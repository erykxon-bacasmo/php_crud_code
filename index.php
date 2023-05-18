<?php

require "connection.php";
$conn = connection();

$sql = "SELECT * FROM test_code_db";
$result = $conn->query($sql);

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample PHP with Datatable</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <h1>Sample PHP with Database</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Age</th>
                <th>Status</th>
                <th>More</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($data = $result->num_rows > 0){
                    while($rows = $result->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $rows['full_name']?></td>
                            <td><?php echo $rows['age']?></td>
                            <td><?php echo $rows['status']?></td>
                            <td><a href="profile.php?id= <?php echo $rows['id']?>">More</a></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan='4'>No data record here!</td></tr>
                <?php }
            ?>    
        </tbody>
    </table>
</body>
</html>