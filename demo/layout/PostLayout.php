<?php 
    function showPost($idsv, $idpost, $content,$title){
        echo '
        <div class="content">
        <div class="post">
            <div class="post--content">
                <h1>
                    ' . ($title) . '
                </h1>
            </div>
            <div class="post--content">
                <p>
                    ' . ($content) . '
                </p>
            </div>
            <div class="post--modify" style="display:flex">
              <div class="createpost--content">
              
        <div class="btn--createpost btn--open">
            <a href="../sinhvien/sv2.php?id='.$idsv.'&idpost='.$idpost.'"><i class="fas fa-edit"></i></a>
        </div>
    </div>';
        echo '
        <div class="createpost--content">
        <form action="../sinhvien/userDeletePost.php?id='.($idsv).'&idpost='.($idpost).'" method="post">        
            <div class="btn--deletepost ">
                <input type="submit" value="delete" class="btn--delete" name="btndelete">
                <i class="fas fa-minus btn--delete-icon"></i>
            </div>
        </form>
        </div>
            </div>
        </div>
    </div>';}
?>
