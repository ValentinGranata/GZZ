<?php

    include_once "../data/db.php";
    include_once "./auto_login.php";
    include_once "./auth.php";

    session_start();

    $error;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $con->real_escape_string(strtolower($_POST["email"]));
        $name = $con->real_escape_string(strtolower($_POST["name"]));
        $surname = $con->real_escape_string(strtolower($_POST["surname"]));
        $password = $con->real_escape_string($_POST["password"]);

        $check_query = "SELECT * FROM user WHERE email = '" . $email . "';";
        $check_res = $con->query($check_query);

        if (mysqli_num_rows($check_res) > 0) {
            $error = "Email gia in uso!";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO user (email, password, name, surname) VALUES ('" . $email . "', '" . $password . "', '" . $name . "', '" . $surname . "');";
            $insert_res = $con->query($insert_query);

            if ($insert_res) {
                generate_token($con->insert_id, $con);
                header("Location: ../profile.php");
                exit();
            } else {
                $error = "Errore durante la creazione dell'utente!";
            }
        }
    }

    mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Register - GZZ</title>

        <script defer src="./script/register.js"></script>
        <link rel="stylesheet" href="/projects/gzz/assets/style/general.css">
    </head>
    <body class="pad center">
        <section>
            <div class="column gap box">
                <p class="title">Register</p>

                <form class="column gap" action="register.php" method="POST">
                    <input class="inner-box" type="email" minlength="3" name="email" placeholder="Email" required>
                    
                    <input class="inner-box" type="text" minlength="3" name="name" placeholder="Nome" required>
                    <input class="inner-box" type="text" minlength="3" name="surname" placeholder="Cognome" required>

                    <input class="inner-box" type="password" minlength="3" id="password" name="password" placeholder="Password" required>
                    <input class="inner-box" type="password" minlength="3" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>

                    <input class="btn inner-box" type="submit" id="submit" value="Submit" disabled>
                </form>

                <p class="switch">Change to&nbsp;<a href="/projects/gzz/auth/login.php">Log In</a></p>
            </div>
        </section>
    </body>
</html>