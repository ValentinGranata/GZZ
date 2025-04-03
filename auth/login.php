<?php

    include_once "../data/db.php";
    include_once "./auto_login.php";

    session_start();

    $error;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $identifier = $con->real_escape_string(strtolower($_POST['identifier']));
        $password = $con->real_escape_string(strtolower($_POST['password']));

        $login_query = "SELECT * FROM user WHERE username = '" . $identifier . "' OR email = '" . $identifier . "';";
        $res = mysqli_query($con, $login_query);

        if (mysqli_num_rows($res) > 0) {
            $user = $res->fetch_assoc();
            $hashed_password = $user["password"];

            if (password_verify($password, $hashed_password)) {
                $token = bin2hex(random_bytes(32));

                $update_token_query = "UPDATE user SET token = '" . $token . "' WHERE username = '" . $user["username"] . "';";
                mysqli_query($con, $update_token_query);

                setcookie('auto_login_token', $token, time() + 60 * 60 * 24 * 30, '/', '', true, true); // 30 days expiry
                $_SESSION['id'] = $user['id'];

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

        <title>Login - Useless</title>

        <link rel="stylesheet" href="/projects/useless/auth/style/auth.css">
        <link rel="stylesheet" href="/projects/useless/style/style.css">
    </head>
    <body class="center column">

        <?php include("../components/header.php") ?>

        <section>
            <div class="auth">
                <div class="left glass top-margin">
                    <p class="title">Login</p>

                    <form action="login.php" method="POST">
                        <input type="text" minlength="3" name="identifier" placeholder="Username/Email" required>
                        <input type="password" minlength="3" name="password" placeholder="Password" required>
                        
                        <input class="btn" type="submit" value="Submit">
                    </form>

                    <p class="switch">Change to&nbsp;<a href="/projects/useless/auth/register.php">Register</a></p>
                </div>
            </div>
        </section>

        <?php include("../components/footer.php") ?>

    </body>
</html>