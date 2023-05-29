<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$query1 = "SELECT id FROM favpl WHERE user = '" . $_SESSION['username'] . "'";
$ress = mysqli_query($conn, $query1) or die(mysqli_error($conn));
$ris = mysqli_fetch_assoc($ress);
if($ris) $id = $ris['id'];
else echo json_encode(array());

// Imposto l'header della risposta
header('Content-Type: application/json');

$client_id = '7c31d32aa0144423b7552e6dcc1ae6b9';
$client_secret = '766243bc9e784813bea9698ac8959dfe';

    // ACCESS TOKEN
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    # Eseguo la POST
    curl_setopt($ch, CURLOPT_POST, 1);
    # Setto body e header della POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
    $token=json_decode(curl_exec($ch), true);
    curl_close($ch);    

    // QUERY EFFETTIVA
    $url = 'https://api.spotify.com/v1/playlists/'.$id.'?market=IT';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    # Imposto il token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
?>