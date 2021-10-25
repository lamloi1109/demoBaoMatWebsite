<?php
session_start();
ob_start();
// Kiểm tra SSID đã lưu
if(isset($_SESSION['uname'])){
    $uname = $_SESSION['uname'];
    $con = new mysqli("localhost","root","","demo");
    $con -> set_charset("utf8");
    $sql = "SELECT auth_token,id from user
    where uname = '".$uname ."'";
    $result = $con->query($sql);
    if( $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $x = $row['auth_token'];
            $authToken = $x;
            $id = $row['id'];
            // Kiểm tra token có hợp lệ hay không ?
            if($authToken != $_COOKIE['PHPSESSID']){
                header("Location: http://localhost:8080/index.html");
                exit();
            }
        }
    }
    // Lấy ra các role để phân quyền
    $authSql = "SELECT * from authorization
    where iduser = '".$id ."'";
    $res = $con->query($authSql);
    if( $res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $roleAdmin = $row['role_admin'];
            $roleSv = $row['role_sinhvien'];
            if($roleAdmin == 1){
                header("Location: http://localhost:8080/demo/admin/dashboard.php?id=1");
                exit();
            } else{
                header("Location: http://localhost:8080/demo/sinhvien/sinhvien.php?id=$id");   
                exit();
            }
        }
    }
} else{
    header("Location: http://localhost:8080/index.html");
    exit();
}
$con->close();
?>

