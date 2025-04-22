<link rel="stylesheet" href="./components/style/header.css">

<header class="column box space">
    <div class="top column gap w">
        <div class="title box center">
            <h1>GZZ</h1>
        </div>

        <nav class="column gap cstart w">
            <a class="btn row gap inner-box start active">
                <img class="icon" src="./assets/img/home.png" alt="icon">
                <p>Home</p>
            </a>
            <a class="btn row gap inner-box start" href="/projects/gzz/create_post.php">
                <img class="icon" src="./assets/img/search.png" alt="icon">
                <p>Post</p>
            </a>
            <a class="btn row gap inner-box start" href="/projects/gzz/profile.php">
                <img class="icon" src="./assets/img/profile.png" alt="icon">
                <p>Profile</p>
            </a>
            <a class="btn row gap inner-box start">
                <img class="icon" src="./assets/img/settings.png" alt="icon">
                <p>Settings</p>
            </a>
        </nav>
    </div>

    <div class="bottom w">
        <a class="profile gap box row start btn" href="/projects/gzz/profile.php">
            <img class="avatar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShYwM33sSN7MtnLIq0k1qjhpoEtSstLE26gA&s" alt="avatar">
            <h1 class="username"><?php echo $name . " " . $surname  ?></h1>
        </a>
    </div>
    
</header>