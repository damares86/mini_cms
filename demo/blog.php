<?php

require "admin/template/inc/header.php";

?>

<div id="bottomContainer">
    <div id="content">
        <div id="blog">
        <?php
        
        require "admin/core/config.php";

        $database = new Database();
        $db = $database->getConnection();
    
        $post = new Post($db);
        $cat = new Categories($db);
        if(filter_input(INPUT_GET,"cat")){
            $post->category_id=filter_input(INPUT_GET,"cat");
            $stmt = $post->showByCatId($from_record_num, $records_per_page);
        }else{
           
        $stmt = $post->showAll($from_record_num, $records_per_page);
    }
        
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
        <p class="metainfo"><?=$blog_category?>: <b><a href="blog.php?cat=<?=$category_id?>"><?=$category_name?></a></b></p>
        <p class="metainfo"><?=$blog_mod?>: <?=$modified?></p>
        <div class="blog_content">
            <?=$summary?>
            <br>
            <a href="post.php?id=<?=$id?>&title=<?=$post_title?>"><?=$blog_continue?> -></a>
        </div>
        <?php
            }
        }
        require "admin/inc/paging.php";
        ?>
        </div>
        <div id="sidebar">
            <div id="sidebar_menu">
                <h2><strong><?=$blog_categories?></strong></h2>
                    <ul>
            <?php
                    require "admin/template/inc/sidebar.php";
                ?>
                    </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php
require "admin/template/inc/footer.php";

?>