<?php
    require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    
    <title>Admin Login Page</title>
</head>
<body>
    <div class="header">
        <h1>ADMIN LOGIN</h1>
    </div>
    <div class="loginBox">
        <form method="post">
            <div id="inputField">
                <span class="material-symbols-rounded">shield_person</span>
                <input type="text" name="UserName" placeholder="Username" required></br></br>
            </div>
            <div id="inputField">
                <span class="material-symbols-rounded">lock</span>
                <input type="password" name="Password" placeholder="Password" required></br></br>
            </div>
            
            <button type="submit" name="Login">
                    <span class="material-symbols-rounded">login</span>
                    LOGIN
            </button>
        </form>
    </div>
</body>
</html>

<?php

    if(isset($_POST["Login"]))
    {
        $sql = "SELECT * FROM `adminlogin` WHERE
         `adminName`='$_POST[UserName]' AND `adminPassword`='$_POST[Password]'";

        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0)
        {
            session_start();
            $_SESSION['AdminUserName'] = $_POST['UserName'];
            header("location: AdminPanel/adminHome.php");
            exit();
        }
        else
        {
            echo "<script> alert('Wrong Username or Password'); </script>";
        }
    }

?>