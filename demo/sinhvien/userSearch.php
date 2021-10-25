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
            //Kiểm tra token có hợp lệ hay không >
            if ($authToken != $_COOKIE['PHPSESSID']) {
                header("Location: http://localhost:8080/index.html");
                exit();
            }
        }
    }
    // Kiểm tra role
    $authSql = "SELECT * from authorization
    where iduser = '" . $id . "'";
    $res = $con->query($authSql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $roleSinhvien = $row['role_sinhvien'];
            if ($roleSinhvien == 0) {
                header("Location: http://localhost:8080/demo/admin/403page.php");
            } else {
                $idsv = $_GET['id'];
                  // if($idsv != $id){
                //     header("Location: http://localhost:8080/demo/sinhvien/sinhvien.php?id=$id");   
                // }
            }
        }
    }
    $con->close();
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
    <link rel="stylesheet" href="../css/header.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <title>Document</title>
</head>

<body>
    <div class="page">
        <!-- Subcontent -->
        <?php include('../layout/subcontent.php') ?>
        <!-- MainContent Header -->
        <div class="main--content">
            <div class="mg-10 bg pd-10 sticky">
                <!-- CreatePost -->
                <div class="search--content">
                    <form action="#">
                        <div class="box--search">
                            <button type='submit' class="btn--search"> Search </button>
                            <input type="search" class="search--text" name="" id="">
                        </div>
                    </form>
                </div>
                <?php include('../layout/btnCreatePost.php') ?>
            </div>
            <!-- MainContent Post -->
            <!-- <?php //include('../posts/postlist.php');
                    ?> -->
            <?php
            if (!empty($_POST['search'])) {
                $search = $_POST['search'];
            }
            include('../layout/PostLayout.php');
            $con = new mysqli("localhost", "root", "", "demo");
            $con->set_charset("utf8");
            $sql = "SELECT content, thoigian,title,idpost from userpost
                where title like  '%$search%' ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    showPost($idsv, $row['idpost'], $row['content'], $row['title']);
                }
            } else {
                echo " <div class='content'>
                <div class='post'>
                    <div class='post--content'>
                        <p>
                            ' Không tìm thấy nội dung mà bạn đang tìm kiếm vui lòng thử lại! '
                        </p>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>

    <!-- Modal Post -->
    <?php include('../layout/modalCreatePost.php'); ?>

    <script src="../js/main.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
</body>

</html>