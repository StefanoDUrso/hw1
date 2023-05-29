<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$id = mysqli_real_escape_string($conn, $_GET['q']);
$query1 = "DELETE FROM favs WHERE id = '".$id."' && user = '" . $_SESSION['username'] . "'";
$res = mysqli_query($conn, $query1) or die(mysqli_error($conn));
$response = array('msg'=> '');
if($res) $response['msg']=true;
else $response['msg']=false;

echo json_encode($response);
?>