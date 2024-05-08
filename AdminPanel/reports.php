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
    <link rel="stylesheet" href="adminStyle.css">
    <link rel="stylesheet" href="reports.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <title>Admin Page</title>
</head>
<body>
    <input type="checkbox" name="" id="check">
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
            <li><a href="adminHome.php"><span class="material-symbols-rounded">home</span> <label> HOME </label> </a></li>
            <li><a href="products.php"><span class="material-symbols-rounded">inventory_2</span> <label> PRODUCTS </label> </a></li>
            <li><a href="suppliers.php"><span class="material-symbols-rounded">conveyor_belt</span> <label> SUPPLIERS </label> </a></li>
            <li><a href="reports.php" id="currentPage"><span class="material-symbols-rounded">inventory</span> <label> REPORTS </label> </a></li>
            <li><a href="userManage.php"><span class="material-symbols-rounded">manage_accounts</span> <label> USERS </label> </a></li>
        </ul>
    </div>

    <div class="main">
        <div class="header">
            <h1>REPORTS</h1><br><br>
            <form method="post">
                <button type="submit" name="Logout">
                    <span class="material-symbols-rounded">logout</span>
                    LOGOUT
                </button>
            </form>
        </div>
        <div class="content">
            <h2>Download Product Report:<h2><br>
            
            <form method="post">
                <button type="submit" name="ProductDl">
                    <span class="material-symbols-rounded">download</span>
                    PDF
                </button>
            </form>
        </div>
    </div>
</body>
</html>

<?php

    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("location: ../homePage.php");
        exit();
    }

    if(isset($_POST['ProductDl']))
    {
        $sql = "SELECT * FROM `product`";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0)
        {
            $myFile = fopen("ProductReport.txt", "w");
            while($res_fetch = mysqli_fetch_assoc($res))
            {
                fwrite($myFile, "Product ID: " . $res_fetch['productID'] .
                ", Product Name : " . $res_fetch['productName'] .
                ", Quantity : " . $res_fetch['quantity'] . "\n");
            }
        } 
    }
?>