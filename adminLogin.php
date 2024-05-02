<?php
    require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Login Page</title>
</head>
<body>
    <div class="loginBox">
        <h1>Admin Login</h1></br></br>
        <form method="post">
            <label>USERNAME</label><br>
            <input type="text" name="UserName" placeholder="UserName"></br></br>
            <label>PASSSWORD</label><br>
            <input type="password" name="Password" placeholder="Password"></br></br>
            <button type="submit" name="Login">LOGIN</button></br></br>
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