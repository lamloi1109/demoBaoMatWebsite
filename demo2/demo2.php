<?php 
 // Nhớ cmt lại lúc demo
    session_start();
    ob_start();
    //Kiểm tra SSID
    if (isset($_SESSION['uname'])) {
        $uname = $_SESSION['uname'];
        $con = new mysqli("localhost", "root", "", "demo");
        $con->set_charset("utf8");
        // Láy ra token trong database
        $sql = "SELECT auth_token, id from user
        where uname = '" . $uname . "'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $x = $row['auth_token'];
                $id = $row['id'];
                $authToken = $x;
                // Kiểm tra token
                if ($authToken != $_COOKIE['PHPSESSID']) {
                    header("Location: http://localhost:8080/demo/admin/403page.php");
                    // header("Location: http://localhost:8080/demo2/login2.php");
                    // exit();
                }   
            }
        }

        //Lấy ra role
     
        $authSql = "SELECT * from authorization
        where iduser = '" . $id . "'";
        $res = $con->query($authSql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $roleSinhvien = $row['role_sinhvien'];
                // kiểm tra role có lệ hay không.
                if ($roleSinhvien == 0) {
                    header("Location: http://localhost:8080/demo/admin/403page.php"); 
                } else {
                    $idsv = $_GET['id'];
                }
            }
        }
    } else {
        header("Location: http://localhost:8080/demo/admin/403page.php");
    } 
?>

<?php 
    echo 'Trang user';
    include('./logout.php');
?>