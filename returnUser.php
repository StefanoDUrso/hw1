<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$result = array('user' => $_SESSION["username"]);

echo json_encode($result);

?>