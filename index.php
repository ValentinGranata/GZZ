<?php 

    include_once "./data/db.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Blog - GZZ</title>

        <link rel="stylesheet" href="./assets/style/style.css">
    </head>
    <body class="row">

        <?php include_once "./components/header.php"; ?>

        <section class="main glass column">
            <div class="post-control">
                <div class="control glass">
                    <img src="./assets/img/up.png" alt="">
                </div>

                <div class="control glass">
                    <img src="./assets/img/down.png" alt="">
                </div>
            </div>

            <div class="user row">
                <img src="./assets/img/profile.png" alt="" class="avatar">
                <h1 class="username">Tremoner</h1>
            </div>

            <div class="content column glass">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque fugit nesciunt iure iusto fuga nostrum obcaecati earum assumenda dignissimos explicabo, delectus distinctio eius. Obcaecati, delectus quos repellendus odio velit blanditiis!</p>
                
                <div class="photo row">
                    <img class="glass" src="https://www.shutterstock.com/image-vector/img-vector-icon-design-on-260nw-2164648583.jpg" alt="">
                </div>
            </div>

            <div class="interaction row">
                <div class="left">
                    <p class="date">07/04/2025</p>
                </div>

                <div class="right row">
                    <div class="info share">
                        <a href="">
                            <img src="./assets/img/share.png" alt="">
                        </a>
                    </div>

                    <div class="info repost row">
                        <a href="">
                            <img src="./assets/img/repost.png" alt="">
                        </a>
                        <p>123</p>
                    </div>

                    <div class="info like row">
                        <a href="">
                            <img src="./assets/img/like.png" alt="">
                        </a>
                        <p>234</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about glass">

        </section>
        
    </body>
</html>