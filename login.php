<?php

//Avvio della session
session_start();
//Verifico l'accesso
if(isset($_SESSION["username"]))
{
    header("Location: home.php");
    exit;
}
//Verficia dell'esistenza di dati POST
if(isset($_POST["username"]) && isset($_POST["password"]))
{
    //Connetto al db
    $conn = mysqli_connect("localhost", "root", "", "hw1.0");
    //Escape
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    //Cerco utenti con le credenziali date
    $query = "SELECT * FROM users WHERE Username = '".$username."'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    //verifico correttezza delle credenziali
    if(mysqli_num_rows($res)>0)
    {
        $entry = mysqli_fetch_assoc($res);
        if (password_verify($_POST['password'], $entry['Password'])) {
        //Imposto la variabile di sessione
        $_SESSION["username"] = $_POST["username"];
        //Vai alla home
        header("Location: home.php");
        mysqli_free_result($res);
        mysqli_close($conn);
        exit;
        }else{
            $errore=true;
        }
    }
    else
    {
        $errore=true;
    }
}else if(isset($_POST["username"]) || isset($_POST["password"])){
    $errore = "Inserisci username e password";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Spotigram </title>
        <link rel = "shortcut icon" href="images/logo.png" type="image/x-icon">
        <link rel= "stylesheet" href="login.css" />
        <meta name= "viewport" content="width=device-width, initial-scale=1">
        <script src="login.js" defer="true"></script>    
    </head>

    <body>

    <div class="container">
        <div class="title">
            <img src="images/logo.png"> <h1> Spotigram </h1>

    </div>
    <div class="login">
        <form name='login' method= 'post'>
            

            <?php
            // Verifica la presenza di errori
            if(isset($errore))
            {
                echo "<p class='errore'>";
                echo "Credenziali non valide.";
                echo "</p>";
            }
            ?>
            <p class="errore hidden"> Compilare tutti i campi </p>
   
    <h2>Effettua il login </h2>
            <label>Nome utente<input type= 'text' name= 'username'></label>
            <label>Password<input type= 'password' name= 'password'></label>
            <label>&nbsp;<input type='submit'></label>
            <p>Non hai un account? <a href="signup.php">Registrati</a></p>
        </form>
        </div>
        </div>
    </body>

</html>