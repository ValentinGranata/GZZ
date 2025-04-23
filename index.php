<?php 

    include_once "./data/db.php";
    include_once "./auth/auto_login.php";
    include_once "./auth/auth.php";

    include_once "./data/post/get_startup.php";
    include_once "./data/comment/get_startup_comments.php";

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
        $startup = get_random_startup($con, $user);
    } else {
        $startup = get_startup($con, $user, $type);
    }

    $comments = null;

    if (isset($startup)) {
        $comments = get_startup_comments($con, $startup["id"]);
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

            <?php if (!isset($startup)) { ?>
                <div class="inner-box h">Nessuna Startup Trovata</div>
            <?php } else { ?>
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
                                <img id="owner-profile-picture" src="/projects/gzz/uploads/<?php echo $startup["owner_profile_picture"]; ?>" alt="" class="icon">
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

            <?php } ?>

            <nav class="row gap w">
                <div class="inner-box center btn error">Back</div>
                <div class="inner-box center btn success">Next</div>
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
                                </div>
                    <?php 
                            } 
                        } 
                    ?>
                </div>
            </div>

            <form class="bottom row gap" method="POST" action="/projects/gzz/data/comment/create_startup_comment.php" id="comment-form">
                <input type="hidden" name="startup_id" value="<?php echo $startup["id"]; ?>">
                <input type="text" name="message" class="box" placeholder="Comment.." minlength="2" maxlength="255" required>
                <input type="submit" value="Send" class="box btn flex">
            </form>
        </section>

        <script>
            const commentsList = document.getElementById("comments-list");

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
                            <p>test</p>
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