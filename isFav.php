<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$response = array('img' => '', 'msg' => '');
$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$id = $_GET['q'];
$query1 = "SELECT * FROM favs WHERE id = '".$id."' && user = '" . $_SESSION['username'] . "'";
$res = mysqli_query($conn, $query1) or die(mysqli_error($conn));

if(mysqli_num_rows($res) > 0){
    $response['img'] = 'images/heart_filled.png';
    $response['msg'] = true;
}else {$response['img'] = 'images/heart.png';
    $response['msg'] = false;
}

echo json_encode($response);
?>