<?php
require "admin/template/inc/header.php";

?>
            <div id="bottomContainer">
                <?php
                $file = basename($_SERVER['PHP_SELF']);
                $page_class = pathinfo($file, PATHINFO_FILENAME);

                $page->page_name=$page_name;
                
                $stmt=$page->showByName();
                $type="custom";
                $count=$page->counter;
                ?>
                <div id="content">
                <?php
                if (isset($_SESSION['loggedin'])) {
            
                    ?>
                <div class="text-right">
                    
                    <a href="admin/index.php?man=page&op=edit&idToMod=<?=$page->id?>&type=<?=$type?>&count=<?=$count?>" class="btn btn-primary btn-sm"><b><?=$regpage_site_edit?></b></a>
                </div>
                    <?php
                }

                $json_file = 'admin/inc/pages/'.$page_class.'.json';
                $data = file_get_contents($json_file);
                $json_arr = json_decode($data, true);


                $counter=$page->counter;
               
                for($i=1;$i<=$counter;$i++){

                ?>
                
                <div class="block block<?=$i?> <?=$page_class?>" style="background-color:<?=$json_arr[$i]['block'.$i.'_bg']?> !important; color:<?=$json_arr[$i]['block'.$i.'_text']?> !important;">

                <?php
                             if($json_arr[$i]['block'.$i.'_type']=="t"){
                     
                                echo $json_arr[$i]['block'.$i.''];

                             }else if($json_arr[$i]['block'.$i.'_type']=="p"){
                                $pict=$json_arr[$i]['block'.$i.'_pict'];
                                ?>

                                <img src="uploads/img/<?=$pict?>">
                                <?php
                             }else if($json_arr[$i]['block'.$i.'_type']=="i"){
                                $info=$json_arr[$i]['block'.$i.'_info'];
                                ?>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="uploads/img/<?=$info?>">
                                    </div>
                                    <div class="col-9">
                                        <?php
                                            echo $json_arr[$i]['block'.$i.'_desc'];
                                        ?>
                                    </div>
                                </div>
                                <?php
                             }else if($json_arr[$i]['block'.$i.'_type']=="b"){

                                $stmt1=$post->showLastPosts();
            
                                while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
        
                                    extract($row);
                                    ?>
                                    <div class="row m-1">
                                        <div class="col-12 col-md-5 img_blog">
                                            <img src="uploads/img/<?=$main_img?>">
                                        </div>
                                        <div class="col-12 col-md-7">
                                        <b><?=$title?></b><br>
                                        <a href="post.php?id=<?=$id?>&title=<?=$post_title?>"><?=$blog_continue?> -></a>
                                        </div>
                                    </div>
                            
                                    
                                    <?php
                                }
                         }else{
                                $gallery_name=$json_arr[$i]['block'.$i.'_type'];
                            
                                $dir="misc/gallery/img/$gallery_name";
                                $images= scandir ($dir);
                                $firstFile = $dir ."/". $images[2];// because [0] = "." [1] = ".." 
                                $folder=$json_arr[$i]['block'.$i.'_type'];
                                $gallery=str_replace("_"," ",$folder);
                                $gallery=ucfirst($gallery);
                
                                ?>
                
                                    <div class="row">
                                        <div class="col-12 text-center">
                                                <h3><b><?=$gallery?></b></h3>
                                        </div>
                                        <div class="col-12">
                                            <a href="misc/gallery/<?=$folder?>.php">
                                                <img src="<?=$firstFile?>" style="max-width:100%; margin:0 auto;">
                                            </a>
                                        </div>                                
                                    </div>
                        <?php
                         }
                         ?>
                </div>
                <?php    
                }
        
              ?>
                    <div class="clearfix"></div>
                </div>
            </div>

<?php
require "admin/template/inc/footer.php";
?>