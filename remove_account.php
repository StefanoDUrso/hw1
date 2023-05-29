<?php 

session_start();
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
$query1 = "DELETE FROM users WHERE Username = '" . $username . "'";
$res = mysqli_query($conn, $query1) or die(mysqli_error($conn));
session_destroy();
?>