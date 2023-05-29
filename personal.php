<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
    $conn = mysqli_connect("localhost", "root", "", "hw1.0");
    $query = "SELECT nome FROM favpl WHERE user = '" . $_SESSION['username'] . "'";
    $res = mysqli_query($conn,$query);
    $ris = mysqli_fetch_assoc($res);
    if($ris) $nome = $ris['nome'];

    $query1= "SELECT * FROM favs WHERE user = '".$_SESSION["username"]."'";
    $res1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($res1) > 0){
        $presente = 1;
    }else $presente = 0;
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Spotigram </title>
        <link rel = "shortcut icon" href="images/logo.png" type="image/x-icon">
        <link rel= "stylesheet" href="personal.css" />
        <meta name= "viewport" content="width=device-width, initial-scale=1">
        <script src="personal.js" defer="true"></script>    
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
<section id='modal-view' class='hidden'> </section>
    <h1>Bentornato <?php echo $_SESSION["username"]; ?></h1>
        <h3> Ecco a te delle canzoni di: <?php if(isset($nome)) echo '<a>'.$nome.'</a>'; else echo '<a href="profile.php">Setta la playlist da visualizzare qui</a>';?> </h3>

        <section id="topten"> </section> 

        <h3> Ecco le tue canzoni preferite: <?php if($presente == 0){echo '<a href="profile.php"> Non hai canzoni preferite, clicca qui per settarle</a>';}  ?> </h3>
        <section id="songs"> </section>

</main>

<footer> 
<div class="footer-content">
    <h3>Stefano D'Urso</h3>
    <p>1000016482</p>
    <p>Spotigram</p>
    <p>Powered by Spotify and iTunes</p>
    </div>
</footer>

    </body>
</html>