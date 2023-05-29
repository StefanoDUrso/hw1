<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

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
    $query = urlencode($_GET["q"]);
    $url = 'https://api.spotify.com/v1/search?q='.$query.'&type=playlist&market=IT';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    # Imposto il token
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
    $res=curl_exec($ch);
    curl_close($ch);

   // echo $res;
$res_array = json_decode($res,true);

$conn = mysqli_connect("localhost", "root", "", "hw1.0");

$items = $res_array['playlists']['items'];

foreach($items as &$elem){
    $id =  $elem['id'];
    $query = "SELECT id FROM favpl WHERE user = '" . $_SESSION['username'] . "'";
    $res1 = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if(mysqli_num_rows($res1) > 0){
        $num = mysqli_fetch_assoc($res1);
    
    if ($num['id'] == $id){
        $elem['msg'] = true;
        $elem['oldId'] = $num['id'];
    }else   {
        $elem['msg'] = false;
        $elem['oldId'] = $num['id'];
    }

    }else{
        $elem['oldId'] = 0;
        $elem['msg'] = false;
    }
    

}

echo json_encode($items);

?>