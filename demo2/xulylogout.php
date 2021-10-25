<?php
 // Nhớ cmt lại lúc demo
session_start();
ob_start();
if(isset( $_SESSION['uname'])){
    $uname = $_SESSION['uname'];
    $con = new mysqli("localhost","root","","demo");
    $con -> set_charset("utf8");
    // Lây ra token
    $sql = "SELECT auth_token,id from user
        where uname = '".$uname ."'";
        $result = $con->query($sql);
        if( $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $authToken = $row['auth_token'];
                // Kiểm tra token có họp lệ hay không
                if($authToken != $_COOKIE['PHPSESSID']){
                    header("Location: http://localhost:8080/index.html");
                    exit();
                }
            }
        }
    $con->query($sql);
        //update lại token là rỗng khi user đăng xuất
    $authSqlQuery = "UPDATE user set auth_token = '' where uname = '$uname'";
    $result = $con->query($authSqlQuery);
    if($result){
        unset($_SESSION['uname']);
        session_destroy();
        header("Location: http://localhost:8080/demo2/login2.php");
        exit();
    }
    $con->close();
}
?>