<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$response = array('msg'=> '', 'json'=>'');
$conn = mysqli_connect("localhost", "root", "", "hw1.0");

try {
$query1 = "SELECT * FROM post join users on users.Username = post.user ORDER BY datas DESC";
//$quer2 = "SELECT img FROM users WHERE Username = '".$_SESSION["username"]."'";


$res = mysqli_query($conn, $query1) or die(mysqli_error($conn));
//$res2 = mysqli_query($conn, $quer2) or die(mysqli_error($conn));
//$results = mysqli_fetch_assoc($res2);


//$response['img'] = $results['img'];

$posts = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $posts[] = $row;
    }
    
    if (!empty($posts)) {
        $response['msg'] = true;
    } else {
        $response['msg'] = false;
    }

    $response['json'] = $posts;

} catch (Exception $e) {
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>
