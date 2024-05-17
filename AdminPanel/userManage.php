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
    <link rel="stylesheet" href="userManage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <title>Manage User</title>
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
            <li><a href="reports.php"><span class="material-symbols-rounded">inventory</span> <label> REPORTS </label> </a></li>
            <li><a href="userManage.php" id="currentPage"><span class="material-symbols-rounded">manage_accounts</span> <label> USERS </label> </a></li>
        </ul>
    </div>

    <div class="main">
        <div class="header">
            <h1>MANAGE USER</h1><br><br>
            <form method="post">
                <button type="submit" name="Logout">
                    <span class="material-symbols-rounded">logout</span>
                    LOGOUT
                </button>
            </form>
        </div>
        <div class="content">
            <div class="addButton">
                <form method="post">
                    <button type="submit" name="AddUser">
                        <span class="material-symbols-rounded">person_add</span>
                        ADD USER
                    </button>
                </form>
            </div>

            <div class="userTable">
                <h2>Current Users:</h2><br>
                <table>
                    <thead>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM `userregister`";
                            $res = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($res) > 0)
                            {
                                while($res_fetch = mysqli_fetch_assoc($res))
                                {
                                    echo "
                                    <tr>
                                        <td>$res_fetch[fullName]</td>
                                        <td>$res_fetch[userName]</td>
                                        <td>$res_fetch[email]</td>
                                        <td>
                                            <a href='userManage.php?id=$res_fetch[userName]'>✖</a>
                                        </td> 
                                    </tr>";
                                }
                            } 
                        ?>
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
        header("location: ../homePage.php");
        exit();
    }

    if(isset($_POST['AddUser']))
    {
        header("location: userRegister.php");
    }

    if(isset($_GET['id']))
    {
        $sql = "DELETE FROM `userregister` WHERE `userName` = '$_GET[id]'";
        $res = mysqli_query($conn, $sql);
    }
?>