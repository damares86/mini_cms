<?php

require "admin/template/inc/header.php";

?>

<div id="bottomContainer" class="pb-1">
    <div class="container-fluid">
    <?php
    $stmt=$page->showAll();

    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
     extract($row);
    ?>
        <div class="row <?=$page_class?>" id="block1" style="background-color:<?=$row['block1_bg']?>; ">
        <?php
        echo $row['block1'];
        ?>
            
        </div>
        <?php
        if($row['block2']){
        ?>
        <div class="row" id="block2">
            
        </div>
        <?php
        }
        if($row['block3']){
        ?>
        <div class="row" id="block3">

        </div>
        <?php
         }
         if($row['block4']){

        ?>
        <div class="row" id="block4">

        </div>
        <?php
        }
    }
        ?>
    </div>
</div>
<?php
require "admin/template/inc/footer.php";

?>