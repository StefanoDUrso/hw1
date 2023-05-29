<?php 

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$result = array('msg' => '');

$conn = mysqli_connect("localhost", "root", "", "hw1.0");
$username = mysqli_real_escape_string($conn,$_SESSION["username"]);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$immagine = mysqli_real_escape_string($conn, $_POST['immagine']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);

$query = "SELECT id FROM favpl WHERE user = '$username'";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
$risultato = mysqli_fetch_assoc($res);
if(!$res){$result['msg'] = "Err";}

if(mysqli_num_rows($res) > 0){

        $query1 = "DELETE FROM favpl WHERE user = '$username'";
        $res1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
        if(!$res1){$result['msg'] = "Err";}
        if($risultato['id'] != $id){        

        $query3 = "INSERT INTO favpl VALUES ( '$id', '$username','$immagine', '$nome')";
        $res3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
        if(!$res3){$result['msg'] = "Err";} else{$result['msg'] = "Inserito";}
    }else{
        $result['msg'] = "Eliminato";
    }

}else{
    $query2 = "INSERT INTO favpl VALUES ( '$id', '$username','$immagine', '$nome')";
    $res2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
    if(!$res2){$result['msg'] = "Err";}
    else{
        $result['msg'] = "Inserito";
    }
}

mysqli_close($conn);
echo json_encode($result);
?>