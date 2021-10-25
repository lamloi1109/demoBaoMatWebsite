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
            // Kiểm tra role ..
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
                    <?php 
                        echo "<form action='./userSearch.php?id=".$idsv."' method='post'>
                               <div class='box--search'>
                                   <button type='submit' class='btn--search' > Search </button>
                                   <input type='search' name='search' class='search--text'  id='search'>
                               </div>
                           </form>"; 
                    ?>
                 
                </div>
                <?php include('../layout/btnCreatePost.php') ?>
            </div>
            <!-- MainContent Post -->
            <?php include('../posts/postlist.php'); ?>
        </div>
    </div>

    <!-- Modal Post -->
    <?php include('../layout/modalCreatePost.php');
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }
    if (!empty($_GET['idpost'])) {
        $idpost = $_GET['idpost'];
    }
    $con = new mysqli("localhost", "root", "", "demo");
    $con->set_charset("utf8");
    $sql = "SELECT content, thoigian,title,idpost from userpost
    where userid = '" . $idsv . "' && idpost = '".$idpost."'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '  
            <div class="modal js--modal-edit">
        <div class="modal--container js--modal--container-edit">
            <div class="modal--closebtn js-modal--closebtn-edit">
                <a href="../sinhvien/sinhvien.php?id=' . $id . '"><i class="fas fa-times"></i></a>
            </div>
            <div class="modal--header">
                <h3 style="color: white">Edit</h3>
            </div>
            <hr style="border-color: #535558;
            opacity: 0.7;
            height: 1px;
        ">
            <div class="modal--body">
                <div class="userpost" style="margin-left: 10px">
                    <img src="' . ($img) . '" alt="avatar" class="avatar avatar--post">
                    <div class="tilte--post">
                        <h4 class="username">' . ($ten) . '</h3>
                            <p class="time--post">' . ($thoigian) . '</p>
                    </div>
                </div>
                <form action="../sinhvien/userUpdatePost.php?id='.($idsv).'&idpost='.($idpost).'" method="post" style="margin-left: 10px">
                    <div class="box--btn">
                        <input type="text" name="titleEdit" autocomplete="off" placeholder="Tiêu đề" value="'.$row['title'].'" class="box--text">
                    </div>
                    <textarea name="textaEdit" id="textaEdit" class="body--text" placeholder="Bạn đang nghĩ gì thế ?">'.$row['content'].'</textarea>
                    <div class="box--btn">
                        <input type="submit" class="btn--postreq" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>';
        }
    }
    $con->close();
    ?>
    

    <script>
        const btns = document.querySelectorAll('.btn--open');
        const modalCreatePost = document.querySelector('.js--modal-create');
        const modalEditPost = document.querySelector('.js--modal-edit');
        modalEditPost.classList.add('open');
        const modalContainerEdit = document.querySelector('.js--modal--container-edit');
        const modalContainer = document.querySelector('.js--modal--container');

        const modalClose = document.querySelector('.js-modal--closebtn');
        const modalCloseEdit = document.querySelector('.js-modal--closebtn-edit');

        const textarea = document.querySelector("textarea");
        let status = true;

        function hideModalCreatePost() {
            modalCreatePost.classList.remove('open');
        }

        function hideModalEditPost() {
            modalEditPost.classList.remove('open');
        }
        btns[0].addEventListener('click', function() {
            modalCreatePost.classList.add('open');
        });
        for (let i = 1; i < btns.length; i++) {
            btns[i].addEventListener('click', function() {
                console.log(1);
                modalEditPost.classList.add('open');
            });
        }
    </script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
</body>

</html>