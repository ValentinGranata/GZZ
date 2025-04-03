<?php 

    $hostname = "127.0.0.1";
    $username = "root";
    $password = "";
    $port = 3306;
    $database = "gzz";

    $con = mysqli_connect(
        $hostname, 
        $username, 
        $password, 
        $database, 
        $port
    );

    if (!$con) die("[DB] Connection failed: " . mysqli_connect_error());
    
?>