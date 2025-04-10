<?php

    session_start();
    
    if (!isset($_COOKIE["auto_login_token"])) {
        header("Location: ./auth/login.php");
        exit();
    }
    
    $id = $_SESSION["id"];
    
    $user_query = "SELECT * FROM user WHERE id = " . $id . ";";
    $user_result = $con->query($user_query);

    if (!$user_result) {
        header("Location: ./auth/logout.php");
        exit();
    }

    $user = $user_result->fetch_assoc();
    $user_id = $user["id"];
    $email = $user["email"];
    $name = $user["name"];
    $surname = $user["surname"];

    //mysqli_close($con);

?>