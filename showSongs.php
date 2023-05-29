<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$query1 = "SELECT * FROM favs WHERE user = '" . $_SESSION['username'] . "'";
$res = mysqli_query($conn, $query1) or die(mysqli_error($conn));

$rows = array();

while ($row = mysqli_fetch_assoc($res)) {
    $rows[] = $row;
}

if(!empty($rows)){
    echo json_encode($rows);
}else echo json_encode(array());
?>