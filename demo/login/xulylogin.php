<?php
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
$mk = md5($passwd);
$con = new mysqli("localhost","root","","demo");
$con -> set_charset("utf8");
// Update token vào trong database ...
$sql = "SELECT * from user
where uname = '".$uname ."' and passwd = '".$mk."'
";
$result = $con->query($sql);
if( $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $tk = $row['uname'];
        // Mỗi lần login tự sinh ra id
        session_regenerate_id();
        $authTOken = session_id();
        $_SESSION['uname'] = $tk;
        $authSqlQuery = "UPDATE user set auth_token = '$authTOken' where uname = '$tk'";
        $result = $con->query($authSqlQuery);
        // Chuyển hướng sang auth
        if($result){
            header("Location:  http://localhost:8080/demo/auth/auth.php");
            exit();
        }
    }
} else{
    echo "fail!!";
}
$con->close();
?>