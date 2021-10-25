  <?php
         echo '
         <div class="modal js--modal-create">
         <div class="modal--container js--modal--container">
             <div class="modal--closebtn js-modal--closebtn">
                 <i class="fas fa-times"></i>
             </div>
             <div class="modal--header">
                 <h3 style="color: white">Tạo ghi chú</h3>
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
                 <form action="../sinhvien/userpost.php?id='.($idsv).'" id="formPost" method="post" style="margin-left: 10px">
                    <div class="box--btn">
                        <input type="text" name="title"  autocomplete="off" placeholder="Tiêu đề" class="box--text">
                    </div>
                     <textarea name="texta" id="texta" class="body--text" placeholder="Bạn đang nghĩ gì thế ?"></textarea>
                     <div class="box--btn">
                         <input type="submit" class="btn--postreq" value="Đăng">
                     </div>
                 </form>
             </div>
         </div>
        </div>
         ';
?>
