<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Spotigram </title>
        <link rel = "shortcut icon" href="images/logo.png" type="image/x-icon">
        <link rel= "stylesheet" href="news.css" />
        <meta name= "viewport" content="width=device-width, initial-scale=1">
        <script src="news.js" defer="true"></script>    
    </head>

    <header>
    <img src="images/menu.png" id="menu">
    <div class="titolo"> 
    <img src="images/logo.png">
    <h1> Spotigram </h1>
    </div>
    </header>
    

    <div class="contenutosidebar hidden">
    <div>
    <a href="home.php">Home</a>
    <a href="news.php">News</a>
    <a href="personal.php">Personal</a>
    <a href="profile.php">Profilo</a>
    <a href="logout.php">Logout</a>
    </div>
   </div>


    <nav>
        <a href="home.php">Home</a>
        <a href="news.php">News</a>
        <a href="personal.php">Personal</a>
        <a href="profile.php">Profilo</a>
        <a href="logout.php">Logout</a>
    </nav>

<body>
<main>


    <section id = "news"> </section>
    

       

</main>

<footer> 
<div class="footer-content">
    <h3>Stefano D'Urso</h3>
    <p>1000016482</p>
    <p>Spotigram</p>
    <p>Powered by Newsdata</p>
    </div>
</footer>

    </body>
</html>