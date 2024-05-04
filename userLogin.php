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
    
    <title>User Login Page</title>
</head>
<body>
    <div class="header">
        <h1>USER LOGIN</h1>
    </div>
    <div class="loginBox">
        <form method="post">
            <div id="inputField">
                <span class="material-symbols-rounded">Person</span>
                <input type="text" name="UserName_Email" placeholder="Username / Email"></br></br>
            </div>
            <div id="inputField">
                <span class="material-symbols-rounded">lock</span>
                <input type="password" name="Password" placeholder="Password"></br></br>
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
        $sql = "SELECT * FROM `userregister` WHERE
         `userName`='$_POST[UserName_Email]' OR `email`='$_POST[UserName_Email]'";

        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0)
        {
            $res_fetch = mysqli_fetch_assoc($res);
            if(password_verify($_POST['Password'], $res_fetch['password']))
            {
                session_start();
                $_SESSION['UserName'] = $_POST['UserName'];
                header("location: UserPanel/userHome.php");
                exit();
            }
            else
            {
                echo "<script> alert('Wrong Username/Email or Password'); </script>";
            }
        }
        else
        {
            echo "<script> alert('Wrong Username/Email or Password'); </script>";
        }
    }

?>