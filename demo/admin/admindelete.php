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
            // Kiểm tra token ... 
            if ($authToken != $_COOKIE['PHPSESSID']) {
                header("Location: http://localhost:8080/index.html");
                exit();
            }
        }
    }
    // Lấy ra role để phân quyền...
    $authSql = "SELECT * from authorization
    where iduser = '" . $id . "'";
    $res = $con->query($authSql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $roleAdmin = $row['role_admin'];
            // Kiểm tra role
            //if ($roleAdmin == 0) {
               //     header("Location: http://localhost:8080/demo/admin/403page.php"); 
            //}else {
                $idsv = $_GET['id'];
                 // Nhớ cmt lại lúc demo
                //     if($idsv != $id){
            //         header("Location: http://localhost:8080/demo/sinhvien/sinhvien.php?id=$id");   
            //     }    
            // }
            //}
        }
    }

} else {
    header("Location: http://localhost:8080/index.html");
    exit();
}
if(isset($_GET['iduser'])){
    $iduser = $_GET['iduser'];
}
// Phải xóa các bản có khóa ngoại của nó trước.
$sql = "DELETE FROM authorization
WHERE iduser = '" . $iduser. "'";
$con->query($sql);
$sql = "DELETE FROM userpost
WHERE userid = '" . $iduser. "'";
$con->query($sql);
$sql = "DELETE FROM user
WHERE id = '" . $iduser. "'";
$con->query($sql);
header("Location: http://localhost:8080/demo/admin/dashboard.php?id=1");
$con->close();
exit();



?>