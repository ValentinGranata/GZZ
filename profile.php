<?php 


    include_once "./data/db.php";
    include_once "./auth/auto_login.php";
    include_once "./auth/auth.php";

    include_once "./uploads/upload_picture.php";

    $user = load_user_data($con);
    $new_name = $con->real_escape_string(strtolower($_POST["name"]));
    $new_surname = $con->real_escape_string(strtolower($_POST["surname"]));
    $new_picture = $_FILES['picture'];

    $info = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($new_picture) && !empty($new_picture['name'])) {
            upload_image("profile_pictures", $new_picture, $con, $user["id"]);
        }

        if ($new_name != $user["name"]) {
            $user_update_name_query = "UPDATE User SET name = '" . $new_name . "' WHERE id = " . $user["id"] . ";";
            $user_update_name_result = $con->query($user_update_name_query);

            if ($user_update_surname_result->num_rows <= 0) {
                $info["type"] = "error";
                $info["message"] = "Errore nell'aggiornameto del nome!";
            }
        }

        if ($new_surname != $user["surname"]) {
            $user_update_surname_query = "UPDATE User SET surname = '" . $new_surname . "' WHERE id = " . $user["id"] . ";";
            $user_update_surname_result = $con->query($user_update_surname_query);

            if ($user_update_surname_result->num_rows <= 0) {
                $info["type"] = "error";
                $info["message"] = "Errore nell'aggiornameto del cognome!";
            }
        }

        $user = load_user_data($con);

        $info["type"] = "success";
        $info["message"] = "Dati Aggiornati!";
    }

    mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $username; ?> - GZZ</title>
        
        <link rel="stylesheet" href="/projects/gzz/assets/style/general.css">
        <script src=""></script>
    </head>
    <body class="pad center">
        <section class="profile filter">
            <div class="box column gap">
                <div class="column gap">
                    <?php 
                        
                        if (!empty($info)) {
                            echo "<div class='box " . $info["type"] . "'>" . $info["message"] . "</div>";
                        }

                    ?>

                    <div class="info columng gap center w">
                        <img class="avatar" src="<?php echo "/projects/gzz/uploads/" . $user["profile_picture"]; ?>" alt="Profile Picture" id="profile-picture">
                        
                        <div class="column gap w">
                            <div class="info inner-box start">
                                <p>#<?php echo $user["id"] ?></p>
                            </div>
                            
                            <div class="info inner-box start">
                                <p><?php echo $user["email"] ?></p>
                            </div>
                        </div>
                    </div>

                    <form action="./profile.php" method="POST" enctype="multipart/form-data" class="column gap">

                        <div class="info inner-box cstart column">
                            <p class="highlight">Profile Picture</p>
                            <input class="inner-box" type="file" name="picture" accept="image/*">
                        </div>
                        
                        <div class="info inner-box cstart column">
                            <p class="highlight">Nome</p>
                            <input class="inner-box" type="text" name="name" value="<?php echo ucfirst($user["name"]) ?>">
                        </div>

                        <div class="info inner-box cstart column">
                            <p class="highlight">Cognome</p>
                            <input class="inner-box" type="text" name="surname" value="<?php echo ucfirst($user["surname"]) ?>">
                        </div>

                        <input type="submit" value="Save" class="btn inner-box success" id="submit">
                    </form>
                </div>

                <div class="row gap w">
                    <a class="inner-box btn success" href="./index.php">Home</a>
                    <a class="inner-box btn error" href="./auth/logout.php">Logout</a>
                </div>
            </div>
        </section>
    </body>
</html>