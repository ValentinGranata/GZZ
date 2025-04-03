<?php

    include_once "../data/db.php";
    include_once "./auto_login.php";

    $error;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $con->real_escape_string(strtolower($_POST["username"]));
        $email = $con->real_escape_string(strtolower($_POST["email"]));
        $name = $con->real_escape_string(strtolower($_POST["name"]));
        $surname = $con->real_escape_string(strtolower($_POST["surname"]));
        $gender = $con->real_escape_string(strtolower($_POST["gender"]));
        $password = $con->real_escape_string($_POST["password"]);

        $check_query = "SELECT * FROM user WHERE username = '" . $username . "' OR email = '" . $email . "';";
        $check_res = $con->query($check_query);

        if (mysqli_num_rows($check_res) > 0) {
            $error = "Email o Username gia in uso!";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO user (username, name, surname, email, gender, password) VALUES ('" . $username . "', '" . $name . "', '" . $surname . "', '" . $email . "', '" . $gender . "', '" . $password . "');";
            
            $insert_res = $con->query($insert_query);

            if ($insert_res) {
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

        <title>Register - Useless</title>

        <script defer src="./script/register.js"></script>

        <link rel="stylesheet" href="/projects/useless/auth/style/auth.css">
        <link rel="stylesheet" href="/projects/useless/style/style.css">
    </head>
    <body class="center column space_btw">

        <?php include("../components/header.php") ?>

        <section>
            <div class="auth">
                <div class="left glass top-margin">
                    <p class="title">Register</p>

                    <form class="center column gap" action="register.php" method="POST">
                        <input type="text" minlength="3" name="username" placeholder="Username" required>
                        <input type="email" minlength="3" name="email" placeholder="Email" required>

                        <input type="text" minlength="3" name="name" placeholder="Nome" required>
                        <input type="text" minlength="3" name="surname" placeholder="Cognome" required>

                        <input type="password" minlength="3" id="password" name="password" placeholder="Password" required>
                        <input type="password" minlength="3" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>

                        <div class="gender">
                            <div class="option">
                                <input type="radio" name="gender" value="male">
                                <label for="male">Male</label>
                            </div>

                            <div class="option">
                                <input type="radio" name="gender" value="female">
                                <label for="female">Female</label>
                            </div>

                            <div class="option">
                                <input type="radio" name="gender" value="other">
                                <label for="other">Other</label>
                            </div>
                        </div>

                        <input class="btn" type="submit" id="submit" value="Submit" disabled>
                    </form>

                    <p class="switch">Change to&nbsp;<a href="/projects/useless/auth/login.php">Log In</a></p>
                </div>
            </div>
        </section>

        <?php include("../components/footer.php") ?>

    </body>
</html>