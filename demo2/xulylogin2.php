<?php
// Bắt đầu phiên làm việc
session_start();
ob_start();
?>
<?php
$uname = $passwd = "";
if(isset($_POST['uname'])){
        $uname = $_POST['uname'];
}    
if(isset($_POST['passwd'])){
    $passwd = $_POST['passwd'];
}
// mã hóa
$mk = md5($passwd);
$con = new mysqli("localhost","root","","demo");
$con -> set_charset("utf8");
$sql = "SELECT id, uname from user
where uname = '".$uname ."' and passwd = '".$mk."'
";
$result = $con->query($sql);
if( $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $id = $row['id'];   
         // Nhớ cmt lại lúc demo
        $tk = $row['uname'];
        //Sinh ra SSID tự động - mỗi lần login sẽ có 1 SSID khác
        session_regenerate_id();
        $authTOken = session_id();
        //Gán SSID như cookie
        $_SESSION['uname'] = $tk;
        //Cập nhật token vào DB
        $authSqlQuery = "UPDATE user set auth_token = '$authTOken' where uname = '$tk'";
        $result = $con->query($authSqlQuery);
        if($result){
            //Nếu có token sẽ sang trang auth để phân quyền
            header("Location:  http://localhost:8080/demo2/auth2.php?id=$id");
            exit();
        }
    }
} else{
    echo "fail!!";
}
$con->close();
?>