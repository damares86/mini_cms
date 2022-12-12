<?php
    require "admin/template/inc/header.php";
    ?>
    
<div id="bottomContainer">
    <?php
if(!$one){
    $file = basename($_SERVER['PHP_SELF']);
    $page_class = pathinfo($file, PATHINFO_FILENAME);

    $page->page_name=$page_class;

    require "admin/template/page_recall.php";

    
}else{

    foreach($page_order as $page_req){
            if($page_req!="login"){
                $page->page_name=$page_req;
                if($page_req=="contact"){
                    require "admin/inc/contact_form.php";
                }else if($page_req=="index"){
                    require "admin/template/page_recall.php";
                }else{
                    ?>
            <div id="<?=$page_req?>">
                <?php
                    require "admin/template/page_recall.php";
                ?>
            </div>
            <?php
                }
            }
        }
        
    }
            ?>
</div>
<?php
            require "admin/template/inc/footer.php";