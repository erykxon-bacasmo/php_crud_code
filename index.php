<?php

require "connection.php";
$conn = connection();

$sql = "SELECT * FROM test_code_db";
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample PHP CRUD</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <!-- For PHP Add function -->
    <?php
    
    if(isset($_POST['add'])){
        $name = $_POST['fname'];
        $age = $_POST['old'];
        $status = $_POST['status'];

        $sql = "INSERT INTO test_code_db (`full_name`, `age`, `status`) VALUES ('$name', '$age', '$status')";
        $conn->query($sql);

        header("location: index.php");
    } 
    ?>
    <h1>Sample PHP with Database</h1>
    <br>
    <!-- Add Record Section -->
    <button id="add-btn" class="add-btn">Add Record</button>

    <!-- Pop Up Modal -->
    <div id="modal" class="modal">
        <!-- container of pop up modal -->
        <div class="modal-content">
            <!-- close button -->
            <span id="close" class="close">&times;</span>
            <!-- content of the modal -->
            <h2>Add Record</h2>
            <!-- syntax that will connect to our database -->
            <form action="" method="post" id="add-form" onsubmit="validateForm()">
                <label>Full Name: </label>
                <input type="text" name="fname" id="full_name" required>
                <br><br>
                <label>Age: </label>
                <input type="number" name="old" id="age" required>
                <br><br>
                <label>Status: </label>
                <select type="select" name="status" id="status" required>
                    <option value="Not to say">None</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorce">Divorce</option>
                    <option value="Complicated">Complicated</option>
                </select> <br><br>
                <button id="submit" type="submit" name="add">Add Record</button>
                <script>
                    function validateForm(){
                        var name = document.getElementById('full_name')
                        var age = document.getElementById('age')
                        var stats = document.getElementById('status')

                        if(name == '' || age == '' || stats == ''){
                            return false;
                        } else {
                            alert("Add Successfully");
                        }
                    }
                </script>
            </form>
        </div>
    </div>

    <br>
    <!-- <div class="add-btn">
        <a href="add.php">Add Data</a>
    </div> -->
    <br>


    <!-- Table Section -->
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
                            <td>
                                <form action="delete.php" method="post">
                                    <a class="td-btn" href="profile.php?id= <?php echo $rows['id']?>">More</a>&nbsp; &nbsp;
                                    <button type="submit" name="delete" id="delete">Delete Record</button>
                                    <input type="hidden" name="row-delete" value="<?php echo $rows['id']?>">

                                    <script>
                                        var deleteBtn = document.getElementById('delete');

                                        deleteBtn.onclick = function(){
                                            alert("Deleted Successfully");
                                        }
                                    </script>
                                </form>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan='4'>No data record here!</td></tr>
                <?php }
            ?>    
        </tbody>
    </table>
    <script src="script.js"></script>
</body>
</html>