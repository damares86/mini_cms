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

        
        $stmt = $post->showAll($from_record_num, $records_per_page);
        
        $total_rows=$post->countAll();

        if($total_rows>0){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                extract($row);
                $cat->id = $category_id;

                $cat->showById();
                                
                $category_name= $cat->category_name;

                $post_title= preg_replace('/\s+/', '_', $title);
                $post_title = strtolower($post_title);
        ?>
        <h1><?=$title?></h1>
        <p class="metainfo">Category: <b><?=$category_name?></b></p>
        <p class="metainfo">Last modified on: <?=$modified?></p>
        <div class="blog_content">
            <h4>Summary</h4>
            <?=$summary?>
            <br>
            <a href="post.php?id=<?=$id?>&title=<?=$post_title?>">Continue reading -></a>
            <hr>
        </div>
        <hr>
        <?php
            }
        }
        require "admin/inc/paging.php";
        ?>
       
    </div>
</div>
<?php
require "admin/template/inc/footer.php";

?>