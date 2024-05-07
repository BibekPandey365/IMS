<?php
    require("../connection.php");
    
    session_start();

    if(!isset($_SESSION['UserName']))
    {
        header("location: ../userLogin.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <title>User Home</title>
</head>

<body>
    <div class="main">
        <div class="header">
            <h1>USER HOME</h1><br><br>
            <form method="post">
                <button type="submit" name="Logout">
                    <span class="material-symbols-rounded">logout</span>
                    LOGOUT
                </button>
            </form>
        </div>
        <div class="content">
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['Logout']))
    {
        session_destroy();
        #header("location: ../adminLogin.php");
        header("location: ../homePage.php");
        exit();
    }

?>