<?php

require "admin/template/inc/header.php";
?>

<div id="bottomContainer">

<div class="row mt-3">
    <div class="col-12 col-lg-8">
    <div id="content">
        <div id="blog">
        <?php
        
        require "admin/core/config.php";



        $total_rows="";

        if(filter_input(INPUT_GET,"cat")){
            $cat_id=filter_input(INPUT_GET,"cat");
            $stmt = $post->showByCatId($cat_id,$from_record_num, $records_per_page);
            $total_rows=$post->countSelected($cat_id);
        }else{           
            $stmt = $post->showAll($from_record_num, $records_per_page);
            $total_rows=$post->countAll();
        }
        		
        if(!empty($stmt)){
            foreach($stmt as $row){
                $categories->id = $row['category_id'];	
                $catArr=explode(",",$row['category_id']);


                $post_title= preg_replace('/\s+/', '_', $row['title']);
                $post_title = strtolower($post_title);

                $date = $row['modified'];
                $newTime = date("d/m/Y",strtotime($date));
                ?>

						

        <h1><?=$row['title']?></h1>
        <p class="metainfo">*** <?=$post_author?>: <b><?=$row['author']?></b> *** <?=$blog_category?>: 
        <?php
            foreach($catArr as $arr){
                if($arr['id']){
                $categories->id = $arr['id'];
                $categories->showById();
                                
                $category_name= $categories->category_name;

        ?>
        | <b><a href="blog.php?cat=<?=$arr['id']?>"><?=$category_name?></a></b> 
    
        <?php
                }
            }
    
		?>
         *** <?=$blog_mod?>: <?=$newTime?> ***</p>
        <div class="blog_content">
        <div class="row">
                <div class="col px-5 text-center my-3">
                    <img src="uploads/img/<?=$row['main_img']?>" class="w-75 img-fluid"><br>
                </div>
            </div>
            <?=$row['summary']?>
            <a href="post.php?id=<?=$row['id']?>&title=<?=$post_title?>"><?=$blog_continue?> -></a>
        </div>
        <?php
            }
        }
        require "admin/template/inc/blog_paging.php";
        ?>
        </div>
    </div>
        </div>
        <div class="col-12 col-lg-4">
            <div id="side_blog">

                <h3><strong><?=$blog_categories?></strong></h3>
                <ul>
                    <?php
                    require "admin/template/inc/sidebar.php";
                    ?>
                    </ul>
                    
                </div>
        <div class="clearfix"></div>
            <div id="side_page">
            <?php
                $t=$time->showAll();
                while($data = $t->fetch(PDO::FETCH_ASSOC)){
                    echo $data['mass'];
                    echo "<div class=\"border\"></div><br>";
                    echo $data['office'];
                }
            ?>
            
            </div>
        </div>
    </div>
    </div>
</div>
<?php
require "admin/template/inc/footer.php";

?>