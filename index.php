<?php 

    include("./data/db.php");
    include("./data/user_data.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gzz</title>

        <link rel="stylesheet" href="./assets/style/general.css">
        <link rel="stylesheet" href="./assets/style/index.css">

        <script defer src="/projects/gzz/data/post/load_post.js"></script>
        <script defer src="/projects/gzz/assets/script/post.js"></script>
    </head>
    <body class="center pad gap">

        <?php include_once('./components/header.php'); ?>

        <section class="posts box column gap">
            <nav class="row gap w center">
                <a id="random-btn" class="inner-box center btn active" href="#">Navigate</a>
                <a id="reposts-btn" class="inner-box center btn" href="#">Reposts</a>
                <a id="saved-btn" class="inner-box center btn" href="#">Saved</a>
                <a id="liked-btn" class="inner-box center btn" href="#">Liked</a>
            </nav>

            <div class="content column box cstart space gap h">
                <div class="top column gap w cstart">
                    <div class="head inner-box row gap start">
                        <h1 id="startup-name" class="title w">Title</h1>
                        <div class="contact inner-box center btn">
                            Contact
                        </div>
                    </div>

                    <div id="startup-description">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis 
                        cupiditate officiis, illo laboriosam ex iusto? Voluptatibus rem, 
                        alias voluptas cum non maiores nostrum odit obcaecati ut at blanditiis delectus dolores.
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis 
                        cupiditate officiis, illo laboriosam ex iusto? Voluptatibus rem, 
                        alias voluptas cum non maiores nostrum odit obcaecati ut at blanditiis delectus dolores.
                    </div>
                </div>

                <div class="bottom column gap w">
                    <img class="post-image" src="#" alt="Banner" id="startup-banner">

                    <div class="info row gap w space">
                        <div class="profile row start gap inner-box">
                            <img id="owner-profile-picture" src="./assets/img/profile.png" alt="" class="icon">
                            <h1 id="startup-owner">Name Surname</h1>
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