<?php
require "connection.php";
$conn = connection();


if(!isset($_SESSION)){
    session_start();
}	

if(isset($_SESSION['user_name'])){
    echo "Welcome ".$_SESSION['user_name']; 
}else{
    echo "Welcome Guest";
}


$sql = "SELECT * FROM test_code_db";
$result = $conn->query($sql);
?>
<?php

if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) { 
    // <!-- <script>
    //     window.location = "login.php";
    // </script> -->


    $session_id=$_SESSION['id'];
    $sql = "SELECT * FROM accounts WHERE user_id = '$session_id'";
    $result = $conn->query($sql);
    $user_rows = $result->fetch_array();

    header("location: login.php");
    // $user_rows = 
    // $user_query = $conn->query("SELECT * FROM user WHERE user_id = '$session_id'") or die(mysqli_errno());
    // $user_row = $user_query->fetch_array();
    // $user_username = $user_row['firstname']." ".$user_row['lastname'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample PHP CRUD</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body>
<?php if(isset($_SESSION['id'])){?>
        <a href="logout.php">Logout</a>
    <?php }?>
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
    <br>
    <h1>Sample PHP CRUD Database</h1>
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
            <h2>Add Record</h2><br>
            <!-- syntax that will connect to our database -->
            <form action="" method="post" id="add-form" onsubmit="validateForm()">
                <label>Full Name: </label>
                <input type="text" name="fname" id="full_name" required>
                <br><br>
                <label>Age: </label>
                <input type="integers" name="old" id="age" required>
                <br><br>
                <label>Status: </label>
                <select name="status" id="status" required>
                    <option value="" hidden></option>
                    <option value="Not to say">Not to say</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorce">Divorce</option>
                    <option value="Complicated">Complicated</option>
                </select> <br><br><br>
                <button id="submit" type="submit" name="add" class="addbtn">Add Record</button>
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
    <table id="example" class="table table-striped" style="width: 80%; margin: auto;">
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="script.js"></script>
</body>
</html>