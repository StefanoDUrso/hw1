<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$response = array('img' => '', 'msg' => '', 'id' => '');
$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$id = $_GET['q'];

$query = "SELECT id FROM favpl WHERE user = '" . $_SESSION['username'] . "'";
$res1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

$num = mysqli_fetch_assoc($res1);

if($id != $num['id']) $response['id']=$num['id'];
else $response['id'] = 0;

$query1 = "SELECT * FROM favpl WHERE id = '".$id."' && user = '" . $_SESSION['username'] . "'";
$res = mysqli_query($conn, $query1) or die(mysqli_error($conn));

if(mysqli_num_rows($res) > 0){
    $response['img'] = 'images/heart_filled.png';
    $response['msg'] = true;
}else {$response['img'] = 'images/heart.png';
    $response['msg'] = false;
}

echo json_encode($response);
?>