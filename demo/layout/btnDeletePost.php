<?php 
    
    echo '
    <div class="createpost--content">
        <form action="../sinhvien/userdeletepost?id='.($idsv).'" method="post">        
            <div class="btn--deletepost ">
                <input type="submit" value="delete" class="btn--delete" name="btndelete">
                <i class="fas fa-minus btn--delete-icon"></i>
            </div>
        </form>
    </div>
    ';
