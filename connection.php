<?php

    $conn = mysqli_connect("localhost", "root", "", "IMS");

    if(mysqli_connect_errno())
    {
        echo "Database Connection Error";
        exit();
    }

?>