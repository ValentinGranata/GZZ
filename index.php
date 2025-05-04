<?php 

    include_once "./data/db.php";
    include_once "./auth/auto_login.php";
    include_once "./auth/auth.php";

    include_once "./data/startup/get_startup.php";
    include_once "./data/comment/get_startup_comments.php";
    include_once "./data/interaction/get_startup_interactions.php";

    $user = load_user_data($con);

    $type = "random";
    $shown = array();
    $startup = array();

    if (isset($_GET["startup_id"])) {
        $startup = get_startup_by_id($con, $_GET["startup_id"]);

        if (!isset($startup)) {
            exit("Startup not found.");
        }
    } else {
        if (isset($_GET["type"])) {
            $type = $_GET["type"];
        }

        if ($type != "random" && $type != "repost" && $type != "save" && $type != "like") {
            exit("Invalid type.");
        }

        if ($type == "random") {
            $startup = get_random_startup($con, $user);
        } else {
            $startup = get_startup_by_type($con, $user, $type);
        }
    }

    $comments = null;

    if (isset($startup)) {
        $comments = get_startup_comments($con, $startup["id"]);
        $interactions = get_startup_interactions($con, $startup["id"]);
        $user_interaction = get_user_interaction($con, $user["id"], $startup["id"]);
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

        <script defer src="/projects/gzz/assets/script/post.js"></script>
        <script>
            const startupId = <?php echo $startup["id"]; ?>;
            const url = new URL(window.location);

            url.searchParams.set("startup_id", startupId);
            window.history.replaceState({}, '', url);

            if (url.searchParams.get("type") == null) {
                url.searchParams.set("type", "random");
                window.history.replaceState({}, '', url);
            }
        </script>
    </head>
    <body class="center pad gap">

        <div id="filter" class="filter hidden"></div>

        <div id="delete-startup-form" class="delete-form box column hidden">
            <h1 class="title">Sicuro di voler eliminare questa Startup?</h1>
            <div class="actions row gap">
                <button class="btn success inner-box" onclick="<?php echo $startup["owner_id"] == $user["id"] ? "toggleStartupDelete()" : ""; ?>">Cancel</button>
                <form action="/projects/gzz/data/startup/delete_startup.php" method="POST">
                    <input type="hidden" name="startup_id" value="<?php echo $startup["id"]; ?>">
                    <input type="submit" value="Delete" class="btn error inner-box">
                </form>
            </div>
        </div>

        <div id="delete-comment-form" class="delete-form box column hidden">
            <h1 class="title">Sicuro di voler eliminare questo Commento?</h1>
            <div class="actions row gap">
                <button class="btn success inner-box" onclick="<?php echo $startup["owner_id"] == $user["id"] ? "toggleCommentDelete()" : ""; ?>">Cancel</button>
                <form class="w" action="/projects/gzz/data/comment/delete_startup_comment.php" method="POST">
                    <input id="current-location" type="hidden" name="redirect_url" value="">
                    <input id="comment-id" type="hidden" name="comment_id">
                    <input type="submit" value="Delete" class="btn error inner-box">
                </form>
            </div>
        </div>

        <?php include_once('./components/header.php'); ?>

        <section class="posts box column gap">
            <nav class="row gap w center">
                <a id="random-btn" class="inner-box center btn active" href="?type=random">Navigate</a>
                <a id="repost-btn" class="inner-box center btn" href="?type=repost">Reposts</a>
                <a id="save-btn" class="inner-box center btn" href="?type=save">Saved</a>
                <a id="like-btn" class="inner-box center btn" href="?type=like">Liked</a>
            </nav>

            <?php if (!isset($startup)) { ?>
                <div class="inner-box h">Nessuna Startup Trovata</div>
            <?php } else { ?>
                <div class="content column box cstart space gap h">
                    <div class="top column gap w cstart h">
                        <div class="head inner-box row gap start">
                            <h1 id="startup-name" class="title w"><?php echo $startup["title"]; ?> </h1>
                            <div class="contact inner-box center btn error" onclick="<?php echo $startup["owner_id"] == $user["id"] ? "toggleStartupDelete()" : ""; ?>">
                                <?php echo $startup["owner_id"] == $user["id"] ? "DELETE" : "CONTACT"; ?>
                            </div>
                        </div>

                        <div id="startup-description" class="inner-box h start cstart">
                            <?php echo $startup["description"]; ?>
                        </div>
                    </div>

                    <div class="bottom column gap w">
                        <img class="post-image inner-box" src="/projects/gzz/uploads/<?php echo $startup["banner"]; ?>" alt="Banner" id="startup-banner">

                        <div class="info row gap w space">
                            <div class="profile row start gap inner-box">
                                <img id="owner-profile-picture" src="/projects/gzz/uploads/<?php echo $startup["owner_profile_picture"]; ?>" alt="" class="icon">
                                <h1 id="startup-owner"><?php echo ucfirst($startup["owner_name"]) . " " . ucfirst($startup["owner_surname"]) ?></h1>
                            </div>

                            <div class="interaction row gap">
                                <div id="save" class="inner-box row gap btn <?php echo isset($user_interaction["save"]) ? "active" : ""; ?>">
                                    <img src="./assets/img/view.png" alt="" class="icon">
                                    <h1><?php echo isset($interactions["save"]) ? $interactions["save"] : "0"; ?></h1>
                                </div>
                                <div id="repost" class="inner-box row gap btn <?php echo isset($user_interaction["repost"]) ? "active" : ""; ?>">
                                    <img src="./assets/img/repost.png" alt="" class="icon">
                                    <h1><?php echo isset($interactions["repost"]) ? $interactions["repost"] : "0"; ?></h1>
                                </div>
                                <div id="like" class="inner-box row gap btn <?php echo isset($user_interaction["like"]) ? "active" : ""; ?>">
                                    <img src="./assets/img/like.png" alt="" class="icon">
                                    <h1><?php echo isset($interactions["like"]) ? $interactions["like"] : "0"; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <nav class="row gap w">
                <!-- <div class="inner-box center btn error">Back</div> -->
                <div class="inner-box center btn success" onclick="nextStartup()">Next</div>
            </nav>
        </section>

        <section class="comments box column space gap">
            <div class="top gap column w">
                <div class="head box row gap center">
                    Comments
                </div>

                <div class="comments-list column gap w" id="comments-list">
                    <?php if (!isset($comments)) { ?>
                        <div class="inner-box">Nessun commento trovato</div>
                    <?php 
                        } else { 
                        
                            foreach ($comments as $comment) { 
                    ?>
                                <div class="comment box gap column cstart w">
                                    <div class="user row gap start">
                                        <img class="icon" src="/projects/gzz/uploads/<?php echo $comment["profile_picture"] ?>" alt="">
                                        <h1><?php echo ucfirst($comment["name"]) . " " . ucfirst($comment["surname"]); ?></h1>
                                    </div>

                                    <p><?php echo $comment["message"]; ?></p>
                                    <p><?php echo $comment["created_at"]; ?></p>

                                    <?php if ($comment["owner_id"] == $user["id"]) { ?>
                                        <button onclick="toggleCommentDelete(<?php echo $comment['comment_id']; ?>)" class="btn error inner-box">Delete</button>
                                    <?php } ?>
                                </div>
                    <?php 
                            } 
                        } 
                    ?>
                </div>
            </div>

            <form class="bottom row gap" method="POST" action="/projects/gzz/data/comment/create_startup_comment.php" id="comment-form">
                <input type="hidden" name="startup_id" value="<?php echo $startup["id"]; ?>">
                <input type="text" name="message" class="inner-box" placeholder="Comment.." minlength="2" maxlength="255" required>
                <input type="submit" value="Send" class="inner-box btn flex">
            </form>
        </section>

        <script>
            const commentsList = document.getElementById("comments-list");

            function getCurrentFormattedTime() {
                const now = new Date();

                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');

                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');

                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            }

            document.getElementById('comment-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                })
                .then(res => res.json())
                .then(response => {
                    console.log("Response:", response);

                    let newComment = `
                        <div class="comment box gap column cstart w">
                            <div class="user row gap start">
                                <img class="icon" src="/projects/gzz/uploads/<?php echo $user["profile_picture"]; ?>" alt="">
                                <h1><?php echo ucfirst($user["name"]) . " " . ucfirst($user["surname"]); ?></h1>
                            </div>
                            <p>${formData.get("message")}</p>
                            <p>${getCurrentFormattedTime()}</p>
                            <button onclick="toggleCommentDelete(${response.comment_id})" class="btn error inner-box">Delete</button>
                        </div>
                    `;

                    commentsList.innerHTML += newComment;
                    form.reset();
                })
                .catch(error => {
                    console.error("Error submitting the form: ", error);
                });
            });
        </script>
        
    </body>
</html>