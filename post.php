<?php

require "admin/template/inc/header.php";

?>
<?php
function get_page_url() {
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
    $protocol = substr($sp, 0, strpos($sp, "/")) . $s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}

// esempio di utilizzo
$url = get_page_url();

?>
<div id="bottomContainer" class="pb-1">
    <div id="content">
        <div id="blog">
        <?php
        require "admin/core/config.php";


        $database = new Database();
        $db = $database->getConnection();
    
        $post = new Post($db);
        $cat = new Categories($db);

        $post_id=filter_input(INPUT_GET,"id");

        $post->id=$post_id;
        $post->showById();
        $category_id = $post->category_id;
        $cat->id = $post->category_id;

        $cat->showById();
                        
        $category_name= $cat->category_name;

                if (isset($_SESSION['loggedin'])) {
                    $type="";
                    if($page->id<8){
                        $type="default";
                    }else{
                        $type="custom";
                    }
                    ?>
                <div class="text-right">
                    
                    <a href="admin/index.php?man=post&op=edit&idToMod=<?=$post_id?>" class="btn btn-primary btn-sm"><b><?=$blog_edit?></b></a>
                </div>
                    <?php
                }
                ?>
        <a href="blog.php"><- Back to blog</a>
        <h1><?=$post->title?></h1>
        <p class="metainfo"><?=$blog_category?>: <b><a href="blog.php?cat=<?=$category_id?>"><?=$category_name?></a></b></p>
        <p class="metainfo"><?=$blog_mod?>: <?=$post->modified?></p>
        <div class="blog_content">
            <div class="row">
                <div class="col px-5">
                    <img src="uploads/img/<?=$post->main_img?>" class="w-100"><br>
                </div>
            </div>
            <?=$post->content?>
            
            <br><br>
            <div class="border p-3">
                <?=$blog_share?>: &nbsp;
                
            <a href="https://twitter.com/share?url=<?=$url?>" target="_blank" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars') ;return false;">
            <i class="fab fa-twitter"></i></a>

                        &nbsp; &nbsp; <a href="https://www.facebook.com/sharer.php?u=<?=$url?>">
                        <i class="fab fa-facebook"></i></a>
                        <!-- <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$url?>">
                            <i class="fa fa-linkedin" data-toggle="tooltip" title="" data-original-title="Linkedin">linkedin</i>
                        </a> -->
            <br>
            </div>
        </div>
        
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