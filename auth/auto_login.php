<?php

    include_once "../data/db.php";   

    session_start();

    $token = $_COOKIE['auto_login_token'];

    if (isset($token)) {
        $user_select_query = "SELECT * FROM User WHERE token = '" . $token . "';";
        $user_select_result = $con->query($user_select_query);

        if ($user_select_result->num_rows > 0) {
            $_SESSION['user_id'] = $user_select_result->fetch_assoc()["id"];
        } else {
            header("Location: /projects/gzz/auth/logout.php");
            exit();
        }
    } else {
        if ($_SERVER["REQUEST_URI"] != "/projects/gzz/auth/login.php" && $_SERVER["REQUEST_URI"] != "/projects/gzz/auth/register.php") {
            header("Location: /projects/gzz/auth/logout.php");
            exit();
        }
    }

?>