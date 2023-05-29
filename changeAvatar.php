<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$result = array('msg' => '');
$img = $_GET['q'];
$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$username = mysqli_real_escape_string($conn,$_SESSION["username"]);

$query = "UPDATE users SET img = '".$img."' WHERE Username = '$username'";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

if($res){
    $result['msg']  = true;
}else $result['msg']  = false;
mysqli_close($conn);
echo json_encode($result);
?>