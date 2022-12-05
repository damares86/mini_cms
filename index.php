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
            
            $page->page_name=$page_req;
            
            ?>
            <div id="<?=$page_req?>">
            <?php
                // TODO: MANAGE CONTACT AND LOGIN PAGES
                require "admin/template/page_recall.php";
                ?>
            </div>
            <?php
        }
        
    }
            ?>
</div>
<?php
            require "admin/template/inc/footer.php";