<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$result = array('msg' => '');
try{
$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$albumCover = mysqli_real_escape_string($conn, $_POST['albumCover']);
$trackName = mysqli_real_escape_string($conn, $_POST['trackName']);
$artist = mysqli_real_escape_string($conn, $_POST['artist']);
$audio = mysqli_real_escape_string($conn, $_POST['audio']);
$genre = mysqli_real_escape_string($conn, $_POST['genre']);
$collectionName = mysqli_real_escape_string($conn, $_POST['collectionName']);

$query = "SELECT id FROM favs WHERE user = '$username'";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
if(!$res){$result['msg'] = "Err";}

if(mysqli_num_rows($res) > 0) {
    $elementoPresente = false;

    while($row = mysqli_fetch_assoc($res)) {
        if($id == $row['id']) {
            $elementoPresente = true;
            break;
        }
    }

    if($elementoPresente) {
        $result['msg'] = "Elemento già presente, lo elimino";
        $query1 = "DELETE FROM favs WHERE user = '$username' AND id = '{$row['id']}'";
            $res1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
            if(!$res1) {
                $result['msg'] = "Err";
            }

    } else {
        $query2 = "INSERT INTO favs VALUES ('$id', '$username', '$albumCover', '$trackName', '$artist', '$audio', '$genre','$collectionName')";
        $res2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        if(!$res2) {
            $result['msg'] = "Err";
        } else {
            $result['msg'] = "Inserito";
        }
    }
} else {
    $query2 = "INSERT INTO favs VALUES ('$id', '$username', '$albumCover', '$trackName', '$artist', '$audio', '$genre', '$collectionName')";
    $res2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
    if(!$res2) {
        $result['msg'] = "Err";
    } else {
        $result['msg'] = "Inserito";
    }
}

    mysqli_close($conn);

} catch (Exception $e) {
    $result['msg'] = "Errore: " . $e->getMessage();
}

echo json_encode($result);
?>