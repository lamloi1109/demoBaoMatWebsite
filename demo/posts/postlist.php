<?php 
include('../layout/PostLayout.php');
$con = new mysqli("localhost", "root", "", "demo");
$con->set_charset("utf8");
$sql = "SELECT content, thoigian,title,idpost from userpost
where userid = '" . $idsv . "'";    
$result = $con->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    showPost($idsv,$row['idpost'],$row['content'],$row['title'] );
    }
}
$con->close();
?>
