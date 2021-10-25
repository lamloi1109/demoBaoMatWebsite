<?php
 // Nhớ cmt lại lúc demo
session_start();
ob_start();
   //Kiểm tra SSID đã lưu
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
                header("Location: http://localhost:8080/demo/admin/403page.php");
            }
        }
    }
} else{
    header("Location: http://localhost:8080/demo/admin/403page.php");
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
</head>
<body>
    <?php 
        // Nhớ cmt lại lúc demo
        echo "<a href='admin2.php?id=$id'>admin</a>";
        echo "<br>";
        echo "<a href='demo2.php?id=$id'>user</a>";
    ?>
    <!-- <a href='admin2.php?id=$id'>admin</a>
    <a href='demo2.php?id=$id'>user</a> -->

</body>
</html>