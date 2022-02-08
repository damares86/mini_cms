<?php

require "admin/template/inc/header.php";

?>

<div id="bottomContainer">
    
    <?php
    $file = basename($_SERVER['PHP_SELF']);
    $page_class = pathinfo($file, PATHINFO_FILENAME);

    $page->page_name=$page_class;
    
    $stmt=$page->showByName();
    ?>

        <div class="row <?=$page_class?>" id="block1" style="background-color:<?=$page->block1_bg?>; color:<?=$page->block1_text?>;">
        <?php
        echo $page->block1;
        ?>
            
        </div>
        <?php
        if($page->block2){
        ?>
        <div class="row <?=$page_class?>" id="block2" style="background-color:<?=$page->block2_bg?>; color:<?=$page->block2_text?>;">
        <?php
        
        echo $page->block2;

        ?>
        </div>
        <?php
        }
        if($page->block3){
        ?>
        <div class="row <?=$page_class?>" id="block3" style="background-color:<?=$page->block3_bg?>; color:<?=$page->block3_text?>; ">
        <?php
        
        echo $page->block3;

        ?>
        </div>
        <?php
         }
         if($page->block4){

        ?>
        <div class="row <?=$page_class?>" id="block4" style="background-color:<?=$page->block4_bg?>; color:<?=$page->block4_text?>; ">
        <?php
        
        echo $page->block4;

        ?>
        </div>
        <?php
        }
    // }
        ?>
        
</div>
<?php
require "admin/template/inc/footer.php";

?>