<?php

require "connection.php";
$conn = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM test_code_db WHERE id = '$id'";
$result = $conn->query($sql);
$rows = $result->fetch_assoc();

?>
<?php

session_start();

if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    $session_id=$_SESSION['id'];
    $sql = "SELECT * FROM accounts WHERE user_id = '$session_id'";
    $result = $conn->query($sql);
    $user_rows = $result->fetch_array();

    header("location: login.php");
} 

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
    <br><br>
    <a href="index.php">Back</a>&nbsp; &nbsp;
    <button id="edit-btn">Edit Record</button>

    <?php
    
    $id = $_GET['id'];

    if(isset($_POST['update'])) {
        $name = $_POST['fname'];
        $age = $_POST['old'];
        $stats = $_POST['status'];

        $sql = "UPDATE test_code_db SET `full_name` = '$name', `age` = '$age', `status` = '$stats' WHERE id = '$id'";
        $conn->query($sql);

        header("location: profile.php?id=" .$id);

    } else if(isset($_POST['cancel'])){
        header("location: profile.php?id=" .$id);
    }

    ?>

    <div id="modalEdit" class="modal">
        <div class="modal-content">
            <h2>Edit Record</h2>
            <form action="" method="post" class="form1" onsubmit="validateForm()">
            <label>Full Name: </label>
                <input type="text" name="fname" value="<?php echo $rows['full_name']?>" required>
                <br><br>
                <label>Age: </label>
                <input type="integers" name="old" value="<?php echo $rows['age']?>" required>
                <br><br>
                <label>Status: </label>
                <select name="status" id="status">
                    <option value="Not to say" <?php echo($rows['status'] == "Not to say")? 'selected': '';?>>None</option>
                    <option value="Single" <?php echo($rows['status'] == "Single")? 'selected': '';?>>Single</option>
                    <option value="Married"<?php echo($rows['status'] == "Married")? 'selected': '';?>>Married</option>
                    <option value="Divorce"<?php echo($rows['status'] == "Divorce")? 'selected': '';?>>Divorce</option>
                    <option value="Complicated" <?php echo($rows['status'] == "Complicated")? 'selected': '';?>>Complicated</option>
                </select> <br><br><br>
                <button type="submit" name="update" class="edt-btn">Edit</button>
            </form>
            <form action="" method="post" class="form2">
                <button type="submit" name="cancel" class="cnl-btn">Cancel</button>
            </form>
        </div>
    </div>
    <script>
        var editBtn = document.getElementById("edit-btn");
        var editModal = document.getElementById("modalEdit");

        editBtn.onclick = function(){
            editModal.style.display = "block";
        };

        window.onclick = function(event){
            if(event.target == editModal){
                editModal.style.display = "none";
            }
        };
    </script>
</body>
</html>