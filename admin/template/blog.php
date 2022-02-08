<?php

require "admin/template/inc/header.php";

?>

<div id="bottomContainer" class="pb-1">
    <div class="container-fluid">
        <?php
        $file = basename($_SERVER['PHP_SELF']);
        $page_class = pathinfo($file, PATHINFO_FILENAME);

        $page->page_name=$page_class;
        
        $stmt=$page->showByName();

        ?>
       
    </div>
</div>
<?php
require "admin/template/inc/footer.php";

?>