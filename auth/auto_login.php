<?php

    include_once "../data/db.php";   

    session_start();

    if (isset($_COOKIE['auto_login_token'])) {
        $token = $_COOKIE['auto_login_token'];

        $query = "SELECT * FROM user WHERE token = '" . $token . "';";
        $res = mysqli_query($con, $query);

        if (mysqli_num_rows($res) > 0) {
            $user = $res->fetch_assoc();
            $_SESSION['id'] = $user['id'];

            header("Location: ../profile.php");
            exit();
        }
    }

?>