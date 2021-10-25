<?php 
    echo '
    <div class="modal js--modal-edit">
    <div class="modal--container js--modal--container-edit">
        <div class="modal--closebtn js-modal--closebtn-edit">
            <i class="fas fa-times"></i>
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
                    <h3 class="username">' . ($ten) . '</h3>
                        <p class="time--post">' . ($thoigian) . '</p>
                </div>
            </div>
            <form action="../sinhvien/userUpdatePost.php?id='.($idsv).'&idpost='.($idpost).'" method="post" style="margin-left: 10px">
                <div class="box--btn">
                    <input type="text" name="titleEdit" placeholder="Tiêu đề" class="box--text">
                </div>
                <textarea name="textaEdit" id="textaEdit" class="body--text" placeholder="Bạn đang nghĩ gì thế ?">'.$content.'</textarea>
                <div class="box--btn">
                    <input type="submit" class="btn--postreq" value="Update">
                </div>
            </form>
        </div>
    </div>
    </div>
    ';
?>