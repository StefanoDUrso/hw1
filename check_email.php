<?php

    
    
    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');
    
    $conn = mysqli_connect("localhost", "root", "", "hw1.0");
    $email = mysqli_real_escape_string($conn, $_GET["q"]);
    $query = "SELECT Email FROM users WHERE Email = '$email'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>