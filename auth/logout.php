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

    header("Location: /projects/gzz/auth/login.php");
    exit();

?>