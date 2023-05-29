<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$query1 = "SELECT * FROM favs WHERE id = '".$id."' && user = '" . $_SESSION['username'] . "'";
$res = mysqli_query($conn, $query1) or die(mysqli_error($conn));


$row = mysqli_fetch_assoc($res);

echo json_encode($row);
?>