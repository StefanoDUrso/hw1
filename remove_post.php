<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$result = array('msg' => '');
$conn = mysqli_connect("localhost", "root", "", "hw1.0");

$id = $_GET['q'];

$query = "DELETE FROM post WHERE id = '".$id."' AND user = '".$_SESSION["username"]."' ";
$res = mysqli_query($conn, $query);
if($res) $result['msg'] = true;
else $result['msg'] = false;
echo json_encode($result);

?>