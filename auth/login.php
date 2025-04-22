<?php

    include_once "../data/db.php";
    include_once "./auto_login.php";
    include_once "./auth.php"; 

    if (isset($_COOKIE['auto_login_token'])) {
        header("Location: /projects/gzz/profile.php");
        exit();
    }

    $info = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $con->real_escape_string(strtolower($_POST['email']));
        $password = $con->real_escape_string(strtolower($_POST['password']));

        $user_select_query = "SELECT * FROM User WHERE email = '" . $email . "';";
        $user_select_result = $con->query($user_select_query);

        if ($user_select_result->num_rows > 0) {
            $user = $user_select_result->fetch_assoc();
            $hashed_password = $user["password"];

            if (password_verify($password, $hashed_password)) {
                generate_token($con, $user["id"]);
                header("Location: /projects/gzz/profile.php");
                exit();
            }
        } else {
            $info["type"] = "error";
            $info["meessage"] = "Utente non trovato!";
        }
    }
    
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
                    <?php 
                    
                        if (!empty($info)) {
                            echo "<div class='box " . $info["type"] . "'>" . $info["message"] . "</div>";
                        }

                    ?>
                    <input class="inner-box" type="text" minlength="3" name="email" placeholder="Email" required>
                    <input class="inner-box" type="password" minlength="3" name="password" placeholder="Password" required>
                    
                    <input class="btn inner-box" type="submit" value="Submit">
                </form>

                <p class="switch">Change to&nbsp;<a href="/projects/gzz/auth/register.php">Register</a></p>
            </div>
        </section>
    </body>
</html>