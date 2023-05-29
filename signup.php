<?php

//Verficia dell'esistenza di dati POST
if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["gender"]))
{
    //Connetto al db
    $conn = mysqli_connect("localhost", "root", "", "hw1.0");
    //Escape
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

    $query1 = "SELECT * FROM users WHERE Username = '".$username."' ";
    $res1 = mysqli_query($conn, $query1);

    if(mysqli_num_rows($res1)>0){
        
        $errore_username= true;
        
    }
    if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
        $errore_user = "Username non valido";
    }

    $query2 = "SELECT * FROM users WHERE Email = '".$email."' ";

    $res2 = mysqli_query($conn, $query2);
    if(mysqli_num_rows($res2)>0){
        
        $errore_email= true;
    }

    if (!(preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password))) {
        $errore_pwd=true;       
    }

    if(strlen($password) <8){
        $errore_pwd2 = true;
     
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
      $errore_email2 = "Email non valida";
    } 

    if(strcmp($_POST["password"], $_POST["passwordconfirm"]) != 0){
        $errore_pwd_confirm = "La password non combaciano";
    }

    
    if(!isset($errore_username) && !isset($errore_user) && !isset($errore_email) && !isset($errore_email2) && !isset($errore_pwd) && !isset($errore_pwd2) && !isset($errore_pwd_confirm) ){
        
        //Creo utenti con le credenziali date

        $pfp = "images/pfp.png";
        $query = " INSERT INTO users (Nome,Cognome,Email,Username,Password,Gender, img) VALUES (\"$name\", \"$surname\", \"$email\", \"$username\", \"$password\", \"$gender\", \"$pfp\")";
        $res = mysqli_query($conn, $query);
        

        if($res){
            mysqli_close($conn);
            header("Location: login.php");
            exit;
        }
    }
    mysqli_close($conn);
}    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Spotigram </title>
        <link rel = "shortcut icon" href="images/logo.png" type="image/x-icon">
        <link rel= "stylesheet" href="signup.css" />
        <meta name= "viewport" content="width=device-width, initial-scale=1">
        <script src="signup.js" defer="true"></script>    
    </head>

    <body>
        <div class="block">
        <div class="title">
        <img src='images/logo.png'>
        <h1>SpotiGram</h1>
        </div>

        <div class="signup-box">
        
            <h2>Effettua la registrazione: </h2>

            
            <main>
                
                <form name='signup' method= 'post'>
                <p id="errore_compilazione" class="errore hidden"> Compilare tutti i campi</p>
                <label>Nome<input type= 'text' name= 'name'></label>
                <label>Cognome<input type= 'text' name= 'surname'></label>
                
                <p id="err_email_regex" class="errore hidden"> Email non valida</p>
                <p id="err_email" class="errore hidden">Email già in uso</p>
                <?php
                if(isset($errore_email)){
                    echo "<p class='errore'>";
                    echo "Email già in uso";
                    echo "</p>";
                }

                if(isset($errore_email2)){
                    echo "<p class='errore'>";
                    echo "Email non valida.";
                    echo "</p>";
                }
                ?>
                <label>Email<input id='email' type= 'text' name= 'email'></label>
                
                <p id="err_username_regex" class="errore hidden">Sono ammesse lettere, numeri e underscore, massimo 16 caratteri</p>
                <p id="err_username" class="errore hidden ">Username già in uso</p>   
                
                <?php
                if(isset($errore_username)){
                    echo "<p class='errore'>";
                    echo "Username già in uso.";
                    echo "</p>";
                }

                if(isset($errore_user)){
                    echo "<p class='errore'>";
                    echo "Username non valido.";
                    echo "</p>";
                }
                
                ?>
                <label>Nome Utente<input id = "username" type= 'text' name= 'username'></label>
                
                <p id="err_password" class="errore hidden">La password deve contenere almeno 8 caratteri</p>
                <p id="err_password_char" class="errore hidden">La password deve contenere almeno un carattere speiciale</p>

                <?php
                     if (isset($errore_pwd)){
                
                        echo "<p class='errore'>";
                        echo "La password non contiene caratteri speciali";
                        echo "</p>";
                    }
                     if(isset($errore_pwd2)){
                     echo "<p class='errore'>";
                    echo "La password è troppo corta";
                    echo "</p>";
                    }
                ?>

                <label>Password<input id="password" type= 'password' name= 'password'></label>

                <?php
                if(isset($errore_email2)){
                    echo "<p class='errore'>";
                    echo "Le password non combaciano.";
                    echo "</p>";
                }
                ?>
                <p id="err_password_confirm" class="errore hidden">Le password non combaciano</p>

                <label>Conferma Password <input id="passwordconfirm" type= 'password' name= 'passwordconfirm'></label>
                <input type='radio' name= 'gender' value="m">Maschio
                <input type='radio' name= 'gender' value="f">Femmina
                <input type='radio' name= 'gender' value="a">Altro                
 
                <label>&nbsp;<input type='submit' value= 'Crea ora'> </label>
                <a href="login.php">Torna al login</a>

                </form>
            </main>          
        </div>
    </div>
    </body>
    

</html>