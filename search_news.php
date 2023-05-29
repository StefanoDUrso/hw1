<?php

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://newsdata.io/api/1/news?apikey=pub_22698be3cd9e28621278d4692cfa255a17973&q=music&country=it&language=it&category=entertainment");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    echo $result;
?>

