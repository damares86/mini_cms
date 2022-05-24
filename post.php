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
        $categories = new Categories($db);

        $post_id=filter_input(INPUT_GET,"id");

        $post->id=$post_id;
        $post->showById();
        $category_id = $post->category_id;
        $categories->id = $post->category_id;

        $categories->showById();
                        
        $category_name= $categories->category_name;

                if (isset($_SESSION['loggedin'])) {
   
                    ?>
                <div class="text-right">
                    
                    <a href="admin/index.php?man=post&op=edit&idToMod=<?=$post_id?>" class="btn btn-primary btn-sm"><b><?=$blog_edit?></b></a>
                </div>
                    <?php
                }
                ?>
        <a href="blog.php"><- Back to blog</a>
        <br><br>
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
            <?php
            $gallery=$post->gall;
            if($gallery!="none"){
            ?>         <!-- Script -->
            <script type='text/javascript'>
            $(document).ready(function(){
            
             // Intialize gallery
             var gallery = $('.gallery a').simpleLightbox();
            
            });
            </script>
                <div class="gallery">
                <div class="row p-2">
                    <?php
                    
                    // Image extensions
                    $image_extensions = array("png","jpg","jpeg","JPG");

                    $dir = "misc/gallery/img/$gallery/";
                    if (is_dir($dir)){
                    
                        if ($dh = opendir($dir)){
                            $count = 1;
                    
                            // Read files
                            while (($file = readdir($dh)) !== false){
                    
                                if($file != '' && $file != '.' && $file != '..'){
                    
                                    // Thumbnail image path
                                    $thumbnail_path = $dir.$file;
                    
                                    // Image path
                                    $image_path = $dir.$file;
                    
                                    $thumbnail_ext = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
                                    $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);
                    
                                    // Check its not folder and it is image file
                                    if(!is_dir($image_path) && 
                                        in_array($thumbnail_ext,$image_extensions) && 
                                        in_array($image_ext,$image_extensions)){
                                    ?>

                                    <!-- Image -->
                                    <div class="col-md-4 col-lg-3">
                                        <a href="<?php echo $image_path; ?>">
                                            <img src="<?php echo $thumbnail_path; ?>" alt="" title="" class="gallery">
                                        </a>
                                    </div>
                                    <!-- --- -->
                                    <?php
                    
                                        // Break
                                        if( $count%4 == 0){
                                        ?>
                                            <div class="clear"></div>
                                        <?php 
                                        }
                                        $count++;
                                    }
                                }
                    
                            }
                        closedir($dh);
                        }
                    }
                    ?>
            </div>

        

      
 
            </div>
            <?php
            }
            ?>
            
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