<?php 

    include_once "./data/db.php";
    include_once "./auth/auto_login.php";
    include_once "./auth/auth.php";

    $user = load_user_data($con);

    $type = "random";
    $shown = array();
    $startup = array();

    if (isset($_GET["type"])) {
        $type = $_GET["type"];
    }

    if ($type != "random" && $type != "repost" && $type != "saved" && $type != "liked") {
        exit("Invalid type.");
    }

    if ($type == "random") {
        $select_viewed_startups_query = "SELECT startup_id FROM Interaction WHERE user_id = " . $user["id"] . " AND type = 'view';";
        $viewed_startup_result = $con->query($select_viewed_startups_query);
        
        if ($viewed_startup_result->num_rows > 0) {
            while ($row = $viewed_startup_result->fetch_assoc()) {
                $shown[] = $row["startup_id"];
            }
        }

        $select_random_startup_query = "SELECT Startup.*, User.id AS owner_id, User.name AS owner_name, User.surname AS owner_surname, User.email AS owner_email FROM Startup INNER JOIN User ON User.id = Startup.owner_id " . (!empty($shown) ? ("WHERE Startup.id NOT IN (" . implode(',', $shown) . ") ") : "") . " ORDER BY RAND() LIMIT 1;";
        $select_random_startup_result = $con->query($select_random_startup_query);

        if ($select_random_startup_result->num_rows <= 0) {
            $reset_view_interaction_query = "DELETE FROM Interaction WHERE user_id = " . $user["id"] . " AND type = 'view';";
            $reset_view_interaction_result = $con->query($reset_view_interaction_query);

            header("Location: ./index.php?type=random");
        }

        $startup = $select_random_startup_result->fetch_assoc();

        $add_view_interaction_query = "INSERT INTO Interaction (startup_id, user_id, type) VALUES (" . $startup["id"] . ", " . $user["id"] . ", 'view');";
        $add_view_interaction_result = $con->query($add_view_interaction_query);

        if (!$add_view_interaction_result) {
            exit("Errore nell'aggiunta dell'interazione.");
        }
    } else {
        $query = "SELECT * FROM Interaction, Startup WHERE Interaction.user_id = " . $user["id"]  . " AND Interaction.type = '" . $type . "' AND Startup.id = Interaction.startup_id ORDER BY Interaction.created_at LIMIT 1;";
        $res = $con->query($query);

        if ($res->num_rows == 0) {
            exit("No startups found.");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gzz</title>

        <link rel="stylesheet" href="./assets/style/general.css">
        <link rel="stylesheet" href="./assets/style/index.css">

        <!-- <script defer src="/projects/gzz/data/post/load_post.js"></script> -->
        <!-- <script defer src="/projects/gzz/assets/script/post.js"></script> -->
    </head>
    <body class="center pad gap">

        <?php include_once('./components/header.php'); ?>

        <section class="posts box column gap">
            <nav class="row gap w center">
                <a id="random-btn" class="inner-box center btn active" href="?type=random">Navigate</a>
                <a id="reposts-btn" class="inner-box center btn" href="?type=repost">Reposts</a>
                <a id="saved-btn" class="inner-box center btn" href="?type=saved">Saved</a>
                <a id="liked-btn" class="inner-box center btn" href="?type=liked">Liked</a>
            </nav>

            <div class="content column box cstart space gap h">
                <div class="top column gap w cstart">
                    <div class="head inner-box row gap start">
                        <h1 id="startup-name" class="title w"><?php echo $startup["title"]; ?> </h1>
                        <div class="contact inner-box center btn">
                            Contact
                        </div>
                    </div>

                    <div id="startup-description">
                        <?php echo $startup["description"]; ?>
                    </div>
                </div>

                <div class="bottom column gap w">
                    <img class="post-image" src="/projects/gzz/uploads/<?php echo $startup["banner"]; ?>" alt="Banner" id="startup-banner">

                    <div class="info row gap w space">
                        <div class="profile row start gap inner-box">
                            <img id="owner-profile-picture" src="./assets/img/profile.png" alt="" class="icon">
                            <h1 id="startup-owner"><?php echo ucfirst($startup["owner_name"]) . " " . ucfirst($startup["owner_surname"]) ?></h1>
                        </div>

                        <div class="interaction row gap">
                            <div class="inner-box row gap btn">
                                <img src="./assets/img/share.png" alt="" class="icon">
                                <h1>12</h1>
                            </div>
                            <div class="inner-box row gap btn">
                                <img src="./assets/img/repost.png" alt="" class="icon">
                                <h1>12</h1>
                            </div>
                            <div class="inner-box row gap btn">
                                <img src="./assets/img/like.png" alt="" class="icon">
                                <h1>12</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="row gap w">
                <div class="inner-box center btn error">Back</div>
                <div class="inner-box center btn success">Next</div>
            </nav>
        </section>

        <section class="comments box column space gap">
            <div class="top gap column">
                <div class="head box row gap center">
                    Comments
                </div>

                <div class="comments-list column gap">
                    <div class="comment box gap column cstart">
                        <div class="user row gap start">
                            <img class="icon" src="./assets/img/profile.png" alt="">
                            <h1>tester</h1>
                        </div>

                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                            Reprehenderit, a dignissimos tempore distinctio sit error 
                            mollitia molestias dolorum impedit. Doloribus quisquam iure 
                            at eaque amet delectus laboriosam voluptatum perferendis repudiandae.
                        </p>
                        <p>25/03/2025</p>
                    </div>

                    <div class="comment box gap column cstart">
                        <div class="user row gap start">
                            <img class="icon" src="./assets/img/profile.png" alt="">
                            <h1>Valentin Granata</h1>
                        </div>

                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                            Reprehenderit, a dignissimos tempore distinctio sit error 
                            mollitia molestias dolorum impedit. Doloribus quisquam iure 
                            at eaque amet delectus laboriosam voluptatum perferendis repudiandae.
                        </p>
                        <p>25/03/2025</p>
                    </div>

                    <div class="comment box gap column cstart">
                        <div class="user row gap start">
                            <img class="icon" src="./assets/img/profile.png" alt="">
                            <h1>Valentin Granata</h1>
                        </div>

                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                            Reprehenderit, a dignissimos tempore distinctio sit error 
                            mollitia molestias dolorum impedit. Doloribus quisquam iure 
                            at eaque amet delectus laboriosam voluptatum perferendis repudiandae.
                        </p>
                        <p>25/03/2025</p>
                    </div>

                    <div class="comment box gap column cstart">
                        <div class="user row gap start">
                            <img class="icon" src="./assets/img/profile.png" alt="">
                            <h1>Valentin Granata</h1>
                        </div>

                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                            Reprehenderit, a dignissimos tempore distinctio sit error 
                            mollitia molestias dolorum impedit. Doloribus quisquam iure 
                            at eaque amet delectus laboriosam voluptatum perferendis repudiandae.
                        </p>
                        <p>25/03/2025</p>
                    </div>
                </div>
            </div>

            <div class="bottom row gap">
                <input type="text" class="box" placeholder="Comment..">
                <div class="box btn flex">></div>
            </div>
        </section>
        
    </body>
</html>