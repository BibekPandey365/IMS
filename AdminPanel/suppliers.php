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
    <link rel="stylesheet" href="suppliers.css">
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
            <li><a href="suppliers.php" id="currentPage"><span class="material-symbols-rounded">conveyor_belt</span> <label> SUPPLIERS </label> </a></li>
            <li><a href="reports.php"><span class="material-symbols-rounded">inventory</span> <label> REPORTS </label> </a></li>
            <li><a href="userManage.php"><span class="material-symbols-rounded">manage_accounts</span> <label> USERS </label> </a></li>
        </ul>
    </div>

    <div class="main">
        <div class="header">
            <h1>SUPPLIERS</h1><br><br>
            <form method="post">
                <button type="submit" name="Logout">
                    <span class="material-symbols-rounded">logout</span>
                    LOGOUT
                </button>
            </form>
        </div>
        <div class="content">
            <div id="addSupplier">
                <h2>Add New Supplier</h2><br>
                <table border="1px" style="border-collapse: collapse;">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                    </thead>
                    <tbody>
                        <tr>
                            <form method="get">
                                <td>
                                    <input type="text" name="Name">
                                </td>
                                <td>
                                    <input type="text" name="Email">
                                </td>
                                <td>
                                    <input type="text" name="Address">
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
            
            <div id="displaySupplier">
                <h2>Avaliable Suppliers</h2><br>
                <table border="1px" style="border-collapse: collapse;">
                    <thead>
                        <th>SupplierID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                $sql = "SELECT * FROM `supplier`";
                                $res = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($res) > 0)
                                {
                                    while($res_fetch = mysqli_fetch_assoc($res))
                                    {
                                        echo "
                                        <tr>
                                            <td>$res_fetch[supplierID]</td>
                                            <td>$res_fetch[supplierName]</td>
                                            <td>$res_fetch[supplierEmail]</td>
                                            <td>$res_fetch[supplierAddress]</td>
                                            <td>
                                                <a href='suppliers.php?id=$res_fetch[supplierID]'>✖</a>
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
        $supplierName = $_GET['Name'];
        $supplierEmail = $_GET['Email'];
        $supplierAddress = $_GET['Address'];
        $qty = $_GET['Qty'];

        if(strlen($supplierName)==0)
        {
            echo "<script> alert('Supplier's name cannot be empty !'); </script>";
        }
        else
        {
        
            $sql = "INSERT INTO `supplier`(`supplierID`, `supplierName`, `supplierEmail`, `supplierAddress`) 
             VALUES ('','$supplierName','$supplierEmail', '$supplierAddress')";
    
            $res = mysqli_query($conn, $sql);
    
            if($res)
            {
                echo "<script> alert('New Supplier Added'); window.location.href='suppliers.php';</script>";
            }
        }
        
    }

    if(isset($_GET['id']))
    {
        $sql = "DELETE FROM `supplier` WHERE `supplierID` = '$_GET[id]'";
        $res = mysqli_query($conn, $sql);
    }
?>