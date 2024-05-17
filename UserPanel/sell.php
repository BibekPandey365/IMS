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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <title>Sell</title>
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
            <li><a href="userHome.php"><span class="material-symbols-rounded">home</span> <label> HOME </label> </a></li>
            <li><a href="purchase.php"><span class="material-symbols-rounded">shopping_cart</span> <label> Purchase </label> </a></li>
            <li><a href="sell.php" id="currentPage"><span class="material-symbols-rounded">sell</span> <label> Sale </label> </a></li>
        </ul>
    </div>

    <div class="main">
        <div class="header">
            <h1>SELL</h1><br><br>
            <form method="post">
                <button type="submit" name="Logout">
                    <span class="material-symbols-rounded">logout</span>
                    LOGOUT
                </button>
            </form>
        </div>
        <div class="content" style="padding: 60px 80px;">
            
            <div id="removeItem">
                <h2>Remove Sold Item</h2><br>
                <table border="1px" style="border-collapse: collapse;">
                    <thead>
                        <th>Date</th>
                        <th>Product Name</th>
                        <th>Selling Quantity</th>
                        <th>Buyer's Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <form method="get">
                                <td>
                                    <input type="date" name="Date">
                                </td>
                                <td>
                                    <select name="ProductID">
                                        <?php
                                            $sql = "SELECT * FROM `product` WHERE 1";

                                            $res = mysqli_query($conn, $sql);
                                            
                                            if(mysqli_num_rows($res) > 0)
                                            {
                                                while($res_fetch = mysqli_fetch_assoc($res))
                                                {
                                                    echo "<option value='$res_fetch[productID]'>$res_fetch[productName]</option>";
                                                }
                                            } 
                                        ?>
                                    </select>
                                </td>
                                
                                <td>
                                    <input type="number" min="1" name="RemoveQty">
                                </td>
                                <td>
                                    <input type="text" name="BuyerName" required>
                                </td>
                                <td>
                                    <button type="submit" name="Remove">Remove</button>
                                </td>
                            </form>
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
        #header("location: ../userLogin.php");
        header("location: ../homePage.php");
        exit();
    }
    
    if(isset($_GET['Remove']))
    {
        $salesDate = $_GET['Date'];
        $productID = $_GET['ProductID'];
        $soldQty = $_GET['RemoveQty'];
        $buyerName = $_GET['BuyerName'];

        #Validating Date
        $salesDateTime = new DateTime($salesDate);
        $todayDateTime = new DateTime();
        if($salesDateTime > $todayDateTime)
        {
            echo "<script> alert('Cannot Record Future Sales') </script>";
            return;
        }
        
        #Getting Current Avaliable Quanitity
        $res = mysqli_query($conn, "SELECT `quantity` FROM `product` WHERE `productID` = $productID");
        $res_fetch = mysqli_fetch_assoc($res);
        $currentQty = $res_fetch['quantity'];

        #Validating Quantity
        if($soldQty <= $currentQty)
        {
            $totalQty = $currentQty - $soldQty;
            #Updating Product Quantity
            $sql = "UPDATE `product` SET `quantity`= $totalQty WHERE `productID` = $productID";
            $res = mysqli_query($conn, $sql);

            #Getting Product Name From Product ID
            $res = mysqli_query($conn, "SELECT `productName` FROM `product` WHERE `productID` = $productID");
            $res_fetch = mysqli_fetch_assoc($res);
            $productName = $res_fetch['productName'];

            #Updating Sales Table
            $sql = "INSERT INTO `sales`(`salesID`, `salesDate`, `productName`, `quantity`, `buyer`)
             VALUES ('','$salesDate','$productName','$soldQty','$buyerName')";
            $res = mysqli_query($conn, $sql);
    
            if($res)
            {
                echo "<script> alert('New Sales Updated'); window.location.href='sell.php';</script>";
            }
        }
        else
        {
            echo "<script> alert('Sales Quantity cannot be greater then Avaliable Quantity'); window.location.href='sell.php';</script>";
        }
        
        
    }
?>
