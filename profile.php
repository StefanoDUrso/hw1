<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }


    $conn = mysqli_connect("localhost", "root", "", "hw1.0")or die(mysqli_connect_error());

    $query = "SELECT * FROM users WHERE Username = '".$_SESSION['username']."' ";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);

    $error = array();
    

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Spotigram </title>
        <link rel = "shortcut icon" href="images/logo.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Montserrat:wght@100&family=Poppins:wght@100&display=swap" rel="stylesheet">
        <link rel= "stylesheet" href="profile.css" />
        <meta name= "viewport" content="width=device-width, initial-scale=1">
        <script src="profile.js" defer="true"></script>    
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
        <div class="profile-container">
        <button id="Delete">Elimina il tuo account </button>
        <img src="images/delete.png" class="hidden" id="media_bin">
        
        <div class="profile-image">
        <div id="overlay"> 
        <div class="avatar">
        
        <img src = "images/camera.png">
        </div>
</div>
                
        <img id="pfp" src= ' <?php echo $row['img']; ?>'>
      
        </div>
        <div class="profile-details">
        <?php
        $query1 = "SELECT * FROM users WHERE Username = '".$_SESSION['username']."' ";
        $res1 = mysqli_query($conn, $query1);
        $data = mysqli_fetch_assoc($res1);
        
        ?>
        <p>Nome: </p><h3> <?php echo $data['Nome'] ?><br></h3><p>Cognome: </p><h3><?php echo $data['Cognome'] ?><br></h3>
        <p>Username:  </p><h3><?php echo $data['Username'] ?><br></h3>
        <p>Email: </p><h3><?php echo $data['Email'] ?></h3>
        
        </div>
        </div>

        <h2> In questa pagina puoi modificare i tuoi preferiti che figureranno nella tua area personale </h2>

        <div class='pl'>
        <h4> Cerca una playlist da aggiungere ai preferiti: </h4>
        <form id="form" method = 'post'>
        <input type='text' id='playlist' name='search'>
        <input type='submit' id='submit2' value='Cerca'>
        </form>
        <section id = "plays"> </section>
        </div>
       
        

        <div class='songs'>
        <h4> Cerca canzoni da aggiungere ai preferiti: </h4>
        <form id="form2">
        <input type='text' id='song' name='search'>
        <input type='submit' id='submit' value='Cerca'>
        </form>
        <section id = "covers"> </section>
        </div>

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
