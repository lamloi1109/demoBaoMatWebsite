<?php 
session_start();
ob_start();
if (isset($_SESSION['uname'])) {
    $uname = $_SESSION['uname'];
    $con = new mysqli("localhost", "root", "", "demo");
    $con->set_charset("utf8");
    // Lấy ra token
    $sql = "SELECT auth_token,id from user
    where uname = '" . $uname . "'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $x = $row['auth_token'];
            $authToken = $x;
            $id = $row['id'];
            // Kiểm tra token có hợp lệ hay không
            if ($authToken != $_COOKIE['PHPSESSID']) {
                header("Location: http://localhost:8080/index.html");
                exit();
            }
        }
    }
    $authSql = "SELECT * from authorization
    where iduser = '" . $id . "'";
    $res = $con->query($authSql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $roleSinhvien = $row['role_sinhvien'];
            // kiểm tra role
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
if(!empty($_POST['texta'])){
    $content = $_POST['texta'];

}
if(!empty($_POST['title'])){
    $title = $_POST['title'];

}

$sql = "INSERT INTO `userpost`(`userid`, `content`,`title`) VALUES ($idsv,'$content','$title')";
$res = $con->query($sql);   
header("Location: http://localhost:8080/demo/sinhvien/sinhvien.php?id=$idsv");
$con->close();  
exit();
?>