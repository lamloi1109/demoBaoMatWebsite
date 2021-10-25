<?php
session_start();
ob_start();
if (isset($_SESSION['uname'])) {
    $uname = $_SESSION['uname'];
    $con = new mysqli("localhost", "root", "", "demo");
    $con->set_charset("utf8");
    // Lấy ra token từ database
    $sql = "SELECT auth_token, id from user
    where uname = '" . $uname . "'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $x = $row['auth_token'];
            $id = $row['id'];
            $authToken = $x;
            // Kiểm tra token có họp lệ hay không
            if ($authToken != $_COOKIE['PHPSESSID']) {
                header("Location: http://localhost:8080/index.html");
                exit();
            }
        }
    }
    // Láy ra các role để phân quyền.
    $authSql = "SELECT * from authorization
    where iduser = '" . $id . "'";
    $res = $con->query($authSql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $roleAdmin = $row['role_admin'];
            //kiểm tra xem user có quyền vào trang hay ko
            // if ($roleAdmin == 0) {
            //          header("Location: http://localhost:8080/demo/admin/403page.php"); 
            // } else {
                 $idsv = $_GET['id'];
                  // Nhớ cmt lại lúc demo
            //         if($idsv != $id){
            //         header("Location: http://localhost:8080/demo/sinhvien/sinhvien.php?id=$id");   
            //     }    
            // }
            
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
                        $sql = "SELECT id,ho, ten, gioitinh from user";
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
                                                <a href="$s"><i class="fas fa-edit"></i></a>
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
    <?php include('../layout/modalCreatePost.php');
    if (!empty($_GET['iduser'])) {
        $iduser = $_GET['iduser'];
    }
    $con = new mysqli("localhost", "root", "", "demo");
    $con->set_charset("utf8");
    $sql = "SELECT id, ho, ten, gioitinh from user
    where id = $iduser
    ";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '  
            <div class="modal js--modal-edit">
        <div class="modal--container js--modal--container-edit modal--container--adminedit">
            <div class="modal--closebtn js-modal--closebtn-edit">
                <a href="../admin/dashboard.php?id=' . $id . '"><i class="fas fa-times"></i></a>
            </div>
            <div class="modal--header">
                <h3 style="color: white">Edit</h3>
            </div>
            <hr style="border-color: #535558;
            opacity: 0.7;
            height: 1px;
        ">
            <div class="modal--body">
                <form action="./xulyupdate.php?iduser=' . $iduser . '" method="post" style="margin-left: 10px">
                    <div class="box--btn">
                        <label for="html">Họ:</label><br>
                        <input type="text" name="lastNameEdit" autocomplete="off" placeholder="Tiêu đề" value="' . $row['ho'] . '" class="box--text">
                    </div>
                    <div class="box--btn">
                        <label for="html">Tên:</label><br>
                        <input type="text" name="NameEdit" autocomplete="off" placeholder="Tiêu đề" value="' . $row['ten'] . '" class="box--text">
                    </div>

                <div class="box--btn">
                    <label for="gender" id="gender">Giới tính</label><br>';
            if ($row['gioitinh'] == 1) {
                echo '
                        <label class="container">Nam
                        <input type="radio" checked="checked" value="1" name="gender">
                        <span class="checkmark"></span>
                        </label>
    
                        <label class="container">Nữ
                        <input type="radio" value="0" name="gender">
                        <span class="checkmark"></span>
                        </label>
                        ';
            } else {
                echo '
                        <label class="container">Nam
                        <input type="radio"  value="1" name="gender">
                        <span class="checkmark"></span>
                        </label>
    
                        <label class="container">Nữ
                        <input type="radio" checked="checked" value="0" name="gender">
                        <span class="checkmark"></span>
                        </label>';
            }
            echo '  
                        </div>
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


</body>

</html>