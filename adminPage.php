<?php
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
    <title>Admin Page</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="post">
        <button type="submit" name="Logout">LOGOUT</button>
    </form>
</body>
</html>

<?php

    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("location: adminLogin.php");
        exit();
    }

?>