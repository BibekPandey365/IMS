<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="stylesheet" href="homePage.css">
    <title>Home Page</title>
</head>
<body>
    <div class="header">
        <div id="logo">
            <a href="homePage.php">
                <img src="Images/NepxelStudio.png">
            </a>
        </div>

        <div id="links">
            <a href="#user">USER</a>
            <a href="#admin">ADMIN</a>
            <a href="#about">ABOUT</a>
        </div>
    </div>

    <div class="content">
        <div class="intro">
            <div id="texts">
                <h1>INVENTORY</h1>
                <h3>MANAGEMENT SYSTEM</h3>
            </div>
        </div>

        <div id="user">
            <div id="forground">
                <h1>USER</h1>
                <h3>
                    User can add or remove items on the investory and view investory level. 
                    They can handel purchase, sales, purchase return and sales return. 
                    User can be sales person, inventory inspector or any employee who need inventory information.
                </h3><br>
                <a href="userLogin.php">
                    <span class="material-symbols-rounded">login</span>
                    LOGIN
                </a>
            </div>
        </div>

        <div id="admin">
            <div id="background">
                <img src="Images/AdminImage.png">
            </div>
            <div id="forground">
                <h1>ADMIN</h1>
                <h3>
                    Admin can manage users, add or remove them from system.
                    Admin can add or remove products avaliable on the investory. 
                    Suppliers can also be added and removed by logging in to admin panel.
                    Admin can see and generate inventoty purchase and sales reports.
                    Admin is usually inventory manager.
                </h3><br>
                <a href="adminLogin.php">
                    <span class="material-symbols-rounded">login</span>
                    LOGIN
                </a>
            </div>
        </div>

        <div id="about">   
            <div id="forground">
                <h1>ABOUT</h1>
                <h3>
                An Inventory Management System (IMS) is a crucial tool for businesses to efficiently
                 track and control their stock. Helps to track inventory level, and when to reorder.
                 Being computrized system all the records are kept safe in database. Only authorized 
                 person can access the inventory information. It helps to generate purchase and sales 
                 reports as well and also keep track of suppliers the goods is supplied from.
                </h3>
            </div>
        </div>
    </div>

    <div class="footer">
        <div id="copyright">
            <label>
                Copyright © 2024 | Nepxel Studio
                <img src="Images/NepxelStudioCropped.png" style="width:18px; height:auto;">
            </label>
            
        </div>
    </div>
</body>
</html>