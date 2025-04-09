<?php

    include_once "../data/db.php";
    include_once "./auto_login.php";
    include_once "./auth.php";

    session_start();

    $error;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $con->real_escape_string(strtolower($_POST['email']));
        $password = $con->real_escape_string(strtolower($_POST['password']));

        $login_query = "SELECT * FROM user WHERE email = '" . $email . "';";
        $res = mysqli_query($con, $login_query);

        if (mysqli_num_rows($res) > 0) {
            $user = $res->fetch_assoc();
            $hashed_password = $user["password"];

            if (password_verify($password, $hashed_password)) {
                generate_token($user["id"], $con);
                header("Location: ../profile.php");
                exit();
            }
        } else {
            $error = "Utente non trovato!";
        }
    }

    mysqli_close($con);
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Login - GZZ</title>

        <link rel="stylesheet" href="/projects/gzz/assets/style/general.css">
    </head>
    <body class="pad center">
        <section>
            <div class="column gap box">
                <p class="title">Login</p>

                <form class="column gap" action="login.php" method="POST">
                    <input class="inner-box" type="text" minlength="3" name="email" placeholder="Email" required>
                    <input class="inner-box" type="password" minlength="3" name="password" placeholder="Password" required>
                    
                    <input class="btn inner-box" type="submit" value="Submit">
                </form>

                <p class="switch">Change to&nbsp;<a href="/projects/gzz/auth/register.php">Register</a></p>
            </div>
        </section>
    </body>
</html>