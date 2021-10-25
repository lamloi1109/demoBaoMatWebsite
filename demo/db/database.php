<?php 
     // Lấy ra thông tin user
     $con = new mysqli("localhost", "root", "", "demo");
     $con->set_charset("utf8");
     $ho = $ten = $img = "";
     $gioitinh = 0;
     $sql = "SELECT * from user
     where id = '" . $idsv . "'";
     $res = $con->query($sql);
     if ($res->num_rows > 0) {
         while ($row = $res->fetch_assoc()) {
             if (isset($row['ho'])) {
                 $ho = $row['ho'];
             }
             if (isset($row['ten'])) {
                 $ten = $row['ten'];
             }
             if (isset($row['img'])) {
                 $img = $row['img'];
             }
             if (isset($row['gioitinh'])) {
                 $gioitinh = $row['gioitinh'];
                 if ($gioitinh == 0) {
                     $gioitinh = "Nu";
                 } else {
                     $gioitinh = "Nam";
                 }
             }
         }
     }
     // Lấy ra thông tin bài post của user
     $content = $thoigian = "";
     $sql = "SELECT content, thoigian,title from userpost
                     where userid = '" . $idsv . "'";
     $result = $con->query($sql);
     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             $thoigian = $row['thoigian'];
             $content = $row['content'];
             $title = $row['title'];
         }
     }
     $con->close();
?>