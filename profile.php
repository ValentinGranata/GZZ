<?php 

    include("./data/db.php");
    include("./data/user_data.php");

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
                    <div class="info">
                        <img class="avatar" src="<?php echo "/projects/gzz/uploads/" . $profile_picture; ?>" alt="Profile Picture" id="profile-picture">
                    </div>

                    <div class="info inner-box">
                        <p class="highlight">Id:</p>
                        <p>#<?php echo $id ?></p>
                    </div>

                    <div class="info inner-box">
                        <p class="highlight">Email:</p>
                        <p><?php echo $email ?></p>
                    </div>

                    <div class="info inner-box">
                        <p class="highlight">Nome:</p>
                        <p><?php echo $name ?></p>
                    </div>

                    <div class="info inner-box">
                        <p class="highlight">Cognome:</p>
                        <p><?php echo $surname ?></p>
                    </div>
                </div>

                <div class="row gap">
                    <a class="inner-box btn" href="./index.php">Home</a>
                    <a class="inner-box btn" href="./auth/logout.php">Logout</a>
                </div>
            </div>
        </section>
    </body>
</html>