<?php
require "admin/template/inc/header.php";

?>
            <div id="bottomContainer">
                <?php
                $file = basename($_SERVER['PHP_SELF']);
                $page_class = pathinfo($file, PATHINFO_FILENAME);

                $page->page_name=$page_name;
                
                $stmt=$page->showByName();
                ?>
                <div id="content">
                <div class="block block1 <?=$page_class?>" style="background-color:<?=$page->block1_bg?>; color:<?=$page->block1_text?>;">
                        <?php
                        echo $page->block1;
                        ?>            
                    </div>
                    <?php
                    if($page->block2){
                    ?>
                    <div class="block block2 <?=$page_class?>" style="background-color:<?=$page->block2_bg?>; color:<?=$page->block2_text?>;">
                    <?php
                        echo $page->block2;
                        ?>  
                    </div>
                    <?php
                    }
                    if($page->block3){
                    ?> 
                    <div class="block block3 <?=$page_class?>" style="background-color:<?=$page->block3_bg?>; color:<?=$page->block3_text?>;">
                    <?php
                        echo $page->block3;
                        ?>  
                    </div>
                    <?php
                    }
                    if($page->block4){
                    ?>
                    <div class="block block4 <?=$page_class?>" style="background-color:<?=$page->block4_bg?>; color:<?=$page->block4_text?>;">
                    <?php
                        echo $page->block4;
                        ?>  
                    </div>
                    <?php
                    }
                    if($page->block5){
                    ?>
                    <div class="block block5 <?=$page_class?>" style="background-color:<?=$page->block5_bg?>; color:<?=$page->block5_text?>;">
                    <?php
                        echo $page->block5;
                        ?>  
                    </div><?php
                    }
                    if($page->block6){
                    ?>
                    <div class="block block6 <?=$page_class?>" style="background-color:<?=$page->block6_bg?>; color:<?=$page->block6_text?>;">
                    <?php
                        echo $page->block6;
                        ?>  
                    </div>
                    <?php
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>

<?php
require "admin/template/inc/footer.php";
?>