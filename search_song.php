<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

    $query = urlencode($_GET["q"]);
    $url = 'https://itunes.apple.com/search?media=music&term='.$query;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    # Imposto il token
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
?>