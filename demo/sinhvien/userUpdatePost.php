<?php 
session_start();
ob_start();
if (isset($_SESSION['uname'])) {
    $uname = $_SESSION['uname'];
    $con = new mysqli("localhost", "root", "", "demo");
    $con->set_charset("utf8");
    // Láy ra token
    $sql = "SELECT auth_token,id from user
    where uname = '" . $uname . "'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $x = $row['auth_token'];
            $authToken = $x;
            $id = $row['id'];
            // Kiểm tra token
            if ($authToken != $_COOKIE['PHPSESSID']) {
                header("Location: http://localhost:8080/index.html");
                exit();
            }
        }
    }
    // Lấy ra role
    $authSql = "SELECT * from authorization
    where iduser = '" . $id . "'";
    $res = $con->query($authSql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $roleSinhvien = $row['role_sinhvien'];
            // Kiểm tra role
            if ($roleSinhvien == 0) {
                header("Location: http://localhost:8080/demo/admin/403page.php");
            } else {
                $idsv = $_GET['id'];
                  // if($idsv != $id){
                //     header("Location: http://localhost:8080/demo/sinhvien/sinhvien.php?id=$id");   
                // }
            }
        }
    }
} else {
    header("Location: http://localhost:8080/index.html");
    exit();
}
if(!empty($_POST['textaEdit'])){
    $content = $_POST['textaEdit'];
}
echo $content;
if(!empty($_POST['titleEdit'])){
    $title = $_POST['titleEdit'];
}
echo $title;

if(isset($_GET['idpost'])){
    $idpost = $_GET['idpost'];

}

$sql = "UPDATE userpost set title = '$title', content = '$content' where userid = '$idsv' and idpost = '$idpost'";
$result = $con->query($sql);
if($result){
    header("Location: http://localhost:8080/demo/sinhvien/sinhvien.php?id=$idsv");
    $con->close();  
    exit();
}
?>