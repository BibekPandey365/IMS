<?php
    require("../connection.php");
    
    session_start();
    
    if(!isset($_SESSION['AdminUserName']))
    {
        header("location: adminLogin.php");
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userRegister.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    
    <title>User Registration Page</title>
</head>
<body>
    <div class="header">
        <h1>ADD USER</h1>
    </div>
    <div class="loginBox">
        <form method="post">
            <div id="inputField">
                <span class="material-symbols-rounded">badge</span>
                <input type="text" name="FullName" placeholder="Fullname" required></br></br>
            </div>
            <div id="inputField">
                <span class="material-symbols-rounded">person</span>
                <input type="text" name="UserName" placeholder="Username" required></br></br>
            </div>
            <div id="inputField">
                <span class="material-symbols-rounded">email</span>
                <input type="email" name="Email" placeholder="Email" required></br></br>
            </div>
            <div id="inputField">
                <span class="material-symbols-rounded">lock</span>
                <input type="password" name="Password" placeholder="Password"></br></br>
            </div>
            
            <button type="submit" name="Register">
                    <span class="material-symbols-rounded">login</span>
                    REGISTER
            </button>
        </form>
    </div>
</body>
</html>

<?php

    if(isset($_POST["Register"]))
    {
        if(strlen($_POST['Password']) < 4)
        {
            echo "<script> alert('ERROR: Password must me atleast 4 characters long'); </script>";
            return;
        }

        $sql = "SELECT * FROM `userregister` WHERE
         `userName`='$_POST[UserName]' OR `password`='$_POST[Password]'";

        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0)
        {
            echo "<script> alert('User Name or Email already used'); </script>";
        }
        else
        {
            $hashedPassword = password_hash($_POST['Password'], PASSWORD_BCRYPT);
            $sql = "INSERT INTO `userregister`(`fullName`, `userName`, `email`, `password`)
             VALUES ('$_POST[FullName]','$_POST[UserName]','$_POST[Email]','$hashedPassword')";
            
            $res = mysqli_query($conn, $sql);

            if($res)
            {
                echo "<script>
                        alert('New User Added');
                        window.location.href='userManage.php';
                      </script>";
            }
            else
            {
                echo "<script> Error Running Query </script>";
            }
        }
    }

?>