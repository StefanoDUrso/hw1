<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$response = array();
$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$albumCover = mysqli_real_escape_string($conn, $_POST['albumCover']);
$trackName = mysqli_real_escape_string($conn, $_POST['trackName']);
$artist = mysqli_real_escape_string($conn, $_POST['artist']);
$audio = mysqli_real_escape_string($conn, $_POST['audio']);
$user = mysqli_real_escape_string($conn, $_SESSION['username']);
$caption = mysqli_real_escape_string($conn, $_POST['caption']);
$genre = mysqli_real_escape_string($conn, $_POST['genre']);
$collectionName = mysqli_real_escape_string($conn, $_POST['collectionName']);


try {
$query1 = "INSERT INTO post (user, albumCover, trackName, artist, audio, caption, datas, id, genre, collectionName)
    SELECT u.Username, '$albumCover', '$trackName', '$artist', '$audio', '$caption', CURRENT_TIMESTAMP(), '$id', '$genre', '$collectionName'
    FROM users u
    WHERE u.Username = '$user'";
$res = mysqli_query($conn, $query1) or die(mysqli_error($conn));

if ($res) {
    $response['msg'] = true;
} else {
    $response['msg'] = false;
}

} catch (Exception $e) {
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>
