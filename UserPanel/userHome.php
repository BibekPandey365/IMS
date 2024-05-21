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
    <link rel="stylesheet" href="../AdminPanel/adminStyle.css">
    <link rel="stylesheet" href="../AdminPanel/adminHome.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <title>User Home</title>
</head>

<body>
    <input type="checkbox" id="check">
    <div class="sidebar">
        <label for="check">
            <span class="material-symbols-rounded" id="open" onclick="openNav()">menu</span>
            <span class="material-symbols-rounded" id="close" onclick="openClose()">close</span>
        </label>

        <script>
            if (localStorage.getItem("sidebarOpen") === "true")
            {
                document.getElementById("check").checked = true;
            }
            
            function openNav() {
                localStorage.setItem("sidebarOpen", "true");
            }
            function openClose() {
                localStorage.setItem("sidebarOpen", "false");
            }
        </script>

        <div id="sidebarHeader">
            <h2>DASHBOARD</h2>
        </div>

        <ul>
            <li><a href="userHome.php" id="currentPage"><span class="material-symbols-rounded">home</span> <label> HOME </label> </a></li>
            <li><a href="purchase.php"><span class="material-symbols-rounded">shopping_cart</span> <label> Purchase </label> </a></li>
            <li><a href="sell.php"><span class="material-symbols-rounded">sell</span> <label> Sale </label> </a></li>
        </ul>
    </div>

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
            <div id="forground">
                <h1>HELLO, <?php echo "$_SESSION[UserName]"; ?></h1>
                <h3>
                    Welcome To User Panel,<br>
                    You can record the purchase and sales of inventory items.
                    The records you submit will be updated in the database.
                    Record the purchase records in purchase page.
                    And record sales records in sales page.
                </h3><br>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['Logout']))
    {
        session_destroy();
        #header("location: ../homePage.php");
        echo "<script> window.location.href='../homePage.php'; </script>";
        exit();
    }

?>