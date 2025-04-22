<?php

    include_once "../data/db.php";
    include_once "./auto_login.php";
    include_once "./auth.php";

    include_once "../uploads/upload_picture.php";

    if (isset($_COOKIE['auto_login_token'])) {
        header("Location: /projects/gzz/profile.php");
        exit();
    }

    $info = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $con->real_escape_string(strtolower($_POST["email"]));
        $name = $con->real_escape_string(strtolower($_POST["name"]));
        $surname = $con->real_escape_string(strtolower($_POST["surname"]));
        $password = $con->real_escape_string($_POST["password"]);
        $picture = $_FILES['picture'];

        $select_user_query = "SELECT * FROM User WHERE email = '" . $email . "';";
        $select_user_result = $con->query($select_user_query);

        if ($select_user_result->num_rows > 0) {
            $info["type"] = "error";
            $info["message"] = "Email gia in uso!";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $create_user_query = "INSERT INTO User (email, password, name, surname) VALUES ('" . $email . "', '" . $password . "', '" . $name . "', '" . $surname . "');";
            $create_user_result = $con->query($create_user_query);
            $user_id = $con->insert_id;

            if ($create_user_result) {
                generate_token($con, $user_id);
                
                if (isset($picture) && !empty($picture['name'])) {
                    upload_image("profile_pictures", $picture, $con, $user_id);
                }

                header("Location: /projects/gzz/profile.php");
                exit();
            } else {
                $info["type"] = "error";
                $info["message"] = "Errore durante la creazione dell'utente!";
            }

            $info["type"] = "success";
            $info["message"] = "Utente creato con successo!";
        }
    }

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

                <form class="column gap" action="register.php" method="POST" enctype="multipart/form-data">
                    <input class="inner-box" type="email" minlength="3" name="email" placeholder="Email" required>
                    
                    <input class="inner-box" type="text" minlength="3" name="name" placeholder="Nome" required>
                    <input class="inner-box" type="text" minlength="3" name="surname" placeholder="Cognome" required>

                    <input class="inner-box" type="password" minlength="3" id="password" name="password" placeholder="Password" required>
                    <input class="inner-box" type="password" minlength="3" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>

                    <input class="inner-box" type="file" name="picture" accept="image/*" placeholder="Profile Picture">

                    <input class="btn inner-box" type="submit" id="submit" value="Submit" disabled>
                </form>

                <p class="switch">Change to&nbsp;<a href="/projects/gzz/auth/login.php">Log In</a></p>
            </div>
        </section>
    </body>
</html>