<?php

require "admin/template/inc/header.php";

?>

<div id="bottomContainer" class="pb-1">
    <div class="container-fluid">
        <?php
        $file = basename($_SERVER['PHP_SELF']);
        $page_class = pathinfo($file, PATHINFO_FILENAME);

        $page->page_name=$page_class;
        require "admin/core/config.php";

        $database = new Database();
        $db = $database->getConnection();
    
        $post = new Post($db);
        $cat = new Categories($db);

        $post_id=filter_input(INPUT_GET,"id");
        
        $post->id=$post_id;
        $post->showById();
        
        $cat->id = $post->category_id;

        $cat->showById();
                        
        $category_name= $cat->category_name;

        ?>
        <h1><?=$post->title?></h1>
        <p class="metainfo">Category: <b><?=$category_name?></b></p>
        <p class="metainfo">Last modified on: <?=$post->modified?></p>
        <div class="blog_content">
            <?=$post->content?>
            <br>
            
        </div>
        

       
    </div>
</div>
<?php
require "admin/template/inc/footer.php";

?>