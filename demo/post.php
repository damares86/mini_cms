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

        ?>
        <h1><?=$post->title?></h1>
        <p class="metainfo">Category: <b><a href="blog.php?cat=<?=$category_id?>"><?=$category_name?></a></b></p>
        <p class="metainfo">Last modified on: <?=$post->modified?></p>
        <div class="blog_content">
            <?=$post->content?>
            <br>
            Share: &nbsp;
            <a href="https://twitter.com/share?url=<?=$url?>" target="_blank" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars') ;return false;">
                            <i class="fa fa-twitter" data-toggle="tooltip" title="" data-original-title="Twitter">twitter</i></a>

                        &nbsp; &nbsp; <a href="https://www.facebook.com/sharer.php?u=<?=$url?>">
                            <i class="fa fa-facebook" data-toggle="tooltip" title="" data-original-title="Facebook">facebook</i></a>
                        <!-- <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$url?>">
                            <i class="fa fa-linkedin" data-toggle="tooltip" title="" data-original-title="Linkedin">linkedin</i>
                        </a> -->
            <br>
            
        </div>
        
        </div>
        <div id="sidebar">
            <div id="sidebar_menu">
            <h2><strong>Categories</strong></h2>
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