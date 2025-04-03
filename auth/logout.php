<?php

    session_start();
    session_destroy();
    setcookie(
        'auto_login_token', 
        '', 
        time() - 3600, 
        '/', 
        '', 
        true, 
        true
    );

    header("Location: ../auth/login.php");
    exit();

?>