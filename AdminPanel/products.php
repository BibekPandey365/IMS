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
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <title>Admin Page</title>
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
            <li><a href="adminHome.php"><span class="material-symbols-rounded">home</span> <label> HOME </label> </a></li>
            <li><a href="products.php" id="currentPage"><span class="material-symbols-rounded">inventory_2</span> <label> PRODUCTS </label> </a></li>
            <li><a href="suppliers.php"><span class="material-symbols-rounded">conveyor_belt</span> <label> SUPPLIERS </label> </a></li>
            <li><a href="reports.php"><span class="material-symbols-rounded">inventory</span> <label> REPORTS </label> </a></li>
            <li><a href="userManage.php"><span class="material-symbols-rounded">manage_accounts</span> <label> USERS </label> </a></li>
        </ul>
    </div>

    <div class="main">
        <div class="header">
            <h1>PRODUCTS</h1><br><br>
            <form method="post">
                <button type="submit" name="Logout">
                    <span class="material-symbols-rounded">logout</span>
                    LOGOUT
                </button>
            </form>
        </div>
        <div class="content">
            
            <div id="addProduct">
                <h2>Add New Product</h2><br>
                <table border="1px" style="border-collapse: collapse;">
                    <thead>
                        <th>Product Name</th>
                        <th>Initial Quantity</th>
                    </thead>
                    <tbody>
                        <tr>
                            <form method="get">
                                <td>
                                    <input type="text" name="Name">
                                </td>
                                <td>
                                    <input type="number" min="0" name="Qty">
                                </td>
                                <td>
                                    <button type="submit" name="Add">Add</button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            
            <div id="displayProduct">
                <h2>Avaliable Products</h2><br>
                <table border="1px" style="border-collapse: collapse;">
                    <thead>
                        <th>ProductID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $sql = "SELECT * FROM `product`";
                                $res = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($res) > 0)
                                {
                                    while($res_fetch = mysqli_fetch_assoc($res))
                                    {
                                        echo "
                                        <tr>
                                            <td>$res_fetch[productID]</td>
                                            <td>$res_fetch[productName]</td>
                                            <td>$res_fetch[quantity]</td>
                                            <td>
                                                <a href='products.php?id=$res_fetch[productID]'>✖</a>
                                            </td> 
                                        </tr>";
                                    }
                                } 
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
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

    if(isset($_GET['Add']))
    {
        $productName = $_GET['Name'];
        $qty = $_GET['Qty'];

        if(strlen($productName)==0)
        {
            echo "<script> alert('Product name cannot be empty !'); </script>";
        }
        else
        {
        
            $sql = "INSERT INTO `product`(`productID`, `productName`, `quantity`) 
             VALUES ('','$productName','$qty')";
    
            $res = mysqli_query($conn, $sql);
    
            if($res)
            {
                echo "<script> alert('New Product Added'); window.location.href='products.php';</script>";
            }
        }
        
    }

    if(isset($_GET['id']))
    {
        $sql = "DELETE FROM `product` WHERE `productID` = '$_GET[id]'";
        $res = mysqli_query($conn, $sql);
    }
?>
