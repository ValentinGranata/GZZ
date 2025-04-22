<?php 

    include_once "./data/db.php";
    include_once "./auth/user_data.php";
    include_once "./uploads/upload_picture.php";

    session_start();
    
    $title = isset($_POST['title']) ? $con->real_escape_string($_POST['title']) : '';
    $description = isset($_POST['description']) ? $con->real_escape_string($_POST['description']) : '';
    $category = isset($_POST['category']) ? $con->real_escape_string($_POST['category']) : '';
    $email = isset($_POST['email']) ? $con->real_escape_string($_POST['email']) : '';
    $banner = $_FILES['banner'];
    
    $info = array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($title) || empty($description) || empty($category) || empty($email)) {
            $message["type"] = "error";
            $message["message"] = 'Inserisci tutti i dati per procedere!';
        } else {
            $check_query = "SELECT * FROM Startup WHERE email = '" . $email . "';";
            $check_result = $con->query($check_query);

            if ($check_result->num_rows > 0) {
                $info["type"] = "error";
                $info["message"] = "Esiste già una startup con questa email!";
            } else {
                $query = "INSERT INTO Startup (title, description, category, email, owner_id) VALUES ('" . $title . "', '" . $description . "', '" . $category . "', '" . $email . "', " . $_SESSION["id"] . ");";
                $result = $con->query($query);

                if ($con->error) {
                    $info["type"] = "error";
                    $info["message"] = "Errore sconosciuto durante la creazione della startup!";
                } else {
                    if (isset($banner) && !empty($banner['name'])) {
                        $startup_id = $con->insert_id;
                        upload_image("startup_banners", $banner, $con, $startup_id);
                    }
                    
                    $info["type"] = "success";
                    $info["message"] = "Startup creata con successo!";
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Post - GZZ</title>

        <link rel="stylesheet" href="/projects/gzz/assets/style/general.css">
    </head>
    <body class="center">

        <section>
            <form class="box column gap" action="./create_post.php" method="POST" enctype="multipart/form-data">
                <?php 
                
                    if (!empty($info)) {
                        echo "<div class='box " . $info["type"] . "'>" . $info["message"] . "</div>";
                    }

                ?>
                <input class="inner-box" type="text" name="title" placeholder="Title" required>
                <input class="inner-box" type="text" name="category" placeholder="Category" required>
                <input class="inner-box" type="email" name="email" placeholder="Email" required>
                <textarea class="inner-box" name="description" placeholder="Description" required></textarea>
                <input class="inner-box" type="file" name="banner" accept="image/*" placeholder="Banner">

                <input class="btn inner-box" type="submit" value="Create Post">
                <a class="btn" href="./index.php">Back</a>
            </form>
        </section>
        
    </body>
</html>