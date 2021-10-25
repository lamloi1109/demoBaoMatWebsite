<?php
session_start();
ob_start();
// Kiểm tra SSID
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
            // id - token
            $id = $row['id'];
            $authToken = $x;
            // Kiểm tra token
            if ($authToken != $_COOKIE['PHPSESSID']) {
                header("Location: http://localhost:8080/index.html");
                exit();
            }   
        }
    }
    // Lấy ra role
    $authSql = "SELECT * from authorization
    where iduser = '" . $id . "'";
    $res = $con->query($authSql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $roleAdmin = $row['role_admin'];
            // kiểm tra role có lệ hay không.
             if ($roleAdmin == 0) {
                      header("Location: http://localhost:8080/demo/admin/403page.php"); 
             } else {
                $idsv = $_GET['id'];
                // Nhớ cmt lại lúc demo
                 if($idsv != $id){
                     header("Location: http://localhost:8080/demo/sinhvien/sinhvien.php?id=$id");   
                 }    
             }
        }
    }
    // Connect database
    include('../db/database.php');
} else {
    header("Location: http://localhost:8080/index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleweb.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <title>ADMIN PAGE</title>
</head>

<body>
    <div class="page">
        <!-- Subcontent -->
        <?php
        echo '
           <div class="sub sticky bg pd-10">
               <h3 class="heading" id="top"></h3>
               <div class="subcontent">
                   <div class="user">
                       <img src="' . ($img) . '" alt="avatar" class="avatar avatar--info">
                       <div class="tilte--post">
                           <h4 class="username">' . ($ten) . '</h3>
                       </div>
                   </div>
               </div>

                <div class="subcontent">
                <div class="user">
                    <div class="tilte--post">
                        <h2 class="username">Danh Sách Thành Viên Nhóm 10 </h3>
                        <h3 class="username">Lâm Gia Toàn - B1807676 </h3>
                        <h3 class="username">Lâm Phước Lợi - B1807572 </h3>
                        <h3 class="username">Vũ Bá Trường Tiến - B1807600</h3>
                    </div>
                </div>
            </div>
           </div>';
        ?>
        <!-- MainContent Header -->
        <div class="main--content">
            <div class="mg-10 bg pd-10 sticky">
                    <h3 class="content--table-title">DEMO BẢO MẬT WEBSITE NHÓM 10</h3>
                <?php include('../auth/logout.php')?>
            </div>
            <!-- MainContent -->
            <div class="content">
                <div class="content--table">
                    <h3 class="content--table-title">Quản Lý Thành Viên</h3>
                    <table class="users--table">
                        <tr>
                            <th style="border: 1px solid black">STT</th>
                            <th style="border: 1px solid black">Họ vầ tên</th>
                            <th style="border: 1px solid black">Giới tính</th>
                            <th colspan="2" style="border: 1px solid black">Options</th>
                        </tr>
                        <?php
                        $con = new mysqli("localhost", "root", "", "demo");
                        $con->set_charset("utf8");
                        $sql = "SELECT id, ho, ten, gioitinh from user";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $stt = 0;
                            while ($row = $result->fetch_assoc()) {
                                $stt = $stt + 1;
                                $hvt = $row['ho'] . ' ' . $row['ten'];
                                $iduser = $row['id'];
                                if ($row['gioitinh'] == 1) {
                                    $gt = 'Nam';
                                } else {
                                    $gt = 'Nữ';
                                }
                                echo '
                                    <tr>
                                        <td style="border: 1px solid black">' . $stt . '</td>
                                        <td style="border: 1px solid black">' . $hvt . '</td>
                                        <td style="border: 1px solid black">' . $gt . '</td>
                                        <td style="border: 1px solid black"> 
                                            <div class="btn--createpost btn--open">
                                                <a href="./adminupdate.php?id=1&iduser=' . $iduser . '"><i class="fas fa-edit"></i></a>
                                            </div>
                                        </td>
                                        <td style="border: 1px solid black"> 
                                            <div class="createpost--content">
                                                <form action="./admindelete.php?iduser=1" method="post">        
                                                    <div class="btn--deletepost ">
                                                        <input type="submit" value="delete" class="btn--delete" name="btndelete">
                                                        <i class="fas fa-minus btn--delete-icon"></i>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>';
                            }
                        }
                        $con->close();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>