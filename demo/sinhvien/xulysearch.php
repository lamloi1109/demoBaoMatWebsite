<?php
if( !empty($_GET['search'])){
    $search = $_GET['search'];
}
include('../layout/PostLayout.php');
$con = new mysqli("localhost", "root", "", "demo");
$con->set_charset("utf8");
$sql = "SELECT content, thoigian,title,idpost from userpost
where title like  '%$search%' ";    
$result = $con->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    showPost($idsv,$row['idpost'],$row['content'],$row['title'] );
    }
}else{
    echo " <div class='content'>
    <div class='post'>
        <div class='post--content'>
            <p>
                ' Không tìm thấy nội dung mà bạn đang tìm kiếm vui lòng thử lại! '
            </p>
        </div>
    </div>s 
        ";
}
$con->close();
?>