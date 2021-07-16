<?php 
function navigation($maxp,$cu){ ?>
    <div class="links"><?php 
        if($cu!=1){
            $cu=$cu-1;
            $link=get_pagenum_link($cu);
         echo '<a class="pro_nav back" id="'.$cu.'" href="'.$link.'">&laquo;</a>';
        } 
        
    for ($i = 1; $i <= $maxp; $i++){
        $link=get_pagenum_link($i);
        echo '<a class="pro_nav" id="'.$i.'" href="'.$link.'">'.$i.'</a>';
    }
    if($maxp!=$cu){
            $cu=$cu+1;
            $link=get_pagenum_link($cu);
         echo '<a class="pro_nav forward" id="'.$cu.'"  href="'.$link.'">&raquo;</a>';
        } ?>
        </div>
        
        <?php

}
?>