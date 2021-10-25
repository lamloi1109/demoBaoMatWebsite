<?php 
session_start();
ob_start();
if (isset($_SESSION['uname'])) {
    $uname = $_SESSION['uname'];
    $con = new mysqli("localhost", "root", "", "demo");
    $con->set_charset("utf8");
    // Láy ra token...
    $sql = "SELECT auth_token,id from user
    where uname = '" . $uname . "'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $x = $row['auth_token'];
            $authToken = $x;
            $id = $row['id'];
            // Kiểm tra token có hợp lệ hay không ?
            if ($authToken != $_COOKIE['PHPSESSID']) {
                header("Location: http://localhost:8080/index.html");
                exit();
            }
        }
    }
    // Láy ra các role 
    $authSql = "SELECT * from authorization
    where iduser = '" . $id . "'";
    $res = $con->query($authSql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $roleAdmin = $row['role_admin'];
            //kiểm tra role
            // if ($roleAdmin == 0) {
            //         header("Location: http://localhost:8080/demo/admin/403page.php"); 
            // }else{
                $idsv = $_GET['id'];
                 // Nhớ cmt lại lúc demo
            //     if($idsv != $id){
            //         header("Location: http://localhost:8080/demo/sinhvien/sinhvien.php?id=$id");   
            //     }    
            // }
        }
    }
} else {
    header("Location: http://localhost:8080/index.html");
    exit();
}
if(!empty($_POST['lastNameEdit'])){
    $ho = $_POST['lastNameEdit'];
}

if(isset($_POST['NameEdit'])){
    $ten = $_POST['NameEdit'];
}
if(isset($_POST['gender'])){
    $gender = $_POST['gender'];
}
if(isset($_GET['iduser'])){
    $iduser = $_GET['iduser'];
}
$sql = "UPDATE user set ho = '$ho', ten = '$ten',gioitinh = $gender where id = '$iduser'";
$result = $con->query($sql);
if($result){
    header("Location: http://localhost:8080/demo/admin/dashboard.php?id=1");
    $con->close();  
    exit();
}
