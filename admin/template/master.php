<?php
require "admin/template/inc/header.php";

?>
            <div id="bottomContainer">
                <?php
                $file = basename($_SERVER['PHP_SELF']);
                $page_class = pathinfo($file, PATHINFO_FILENAME);

                $page->page_name=$page_name;
                
                $stmt=$page->showByName();
                ?>
                <div id="content">
                <?php
                if (isset($_SESSION['loggedin'])) {
                    $type="";
                    if($page->id<8){
                        $type="default";
                    }else{
                        $type="custom";
                    }
                    ?>
                <div class="text-right">
                    
                    <a href="admin/index.php?man=page&op=edit&idToMod=<?=$page->id?>&type=<?=$type?>" class="btn btn-primary btn-sm"><b><?=$regpage_site_edit?></b></a>
                </div>
                    <?php
                }
                ?>
                <div class="block-row">
                    <div class="block block1 <?=$page_class?>" style="background-color:<?=$page->block1_bg?> !important; color:<?=$page->block1_text?> !important;">
                        <?php
                        echo $page->block1;
                        ?>            
                    </div>
                    <?php 
                    if($page->layout=="default"||$page->layout=="variant1"){
                    ?>
                </div>
                <div class="block-row">
                    <?php
                    }
                         if($page->block2_type!="n"){
                             ?>
                             <div class="block block2 <?=$page_class?>" style="background-color:<?=$page->block2_bg?> !important; color:<?=$page->block2_text?> !important;">
                             <?php
                             if($page->block2_type=="t"){
                         ?>
                         <?php
                             echo $page->block2;
                             ?>  
                         <?php
                             }else if($page->block2_type=="b"){
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
                                 echo "</ul>";
                             }else{
                                $dir="misc/gallery/img/$page->block2_type/";
                                $images= scandir ($dir);
                                $firstFile = $dir ."/". $images[2];// because [0] = "." [1] = ".." 
                                 $folder=$page->block2_type;
                                 $gallery=str_replace("_"," ",$folder);
                                 $gallery=ucfirst($gallery);
                
                                ?>
                
                                                     <div class="row">
                                                        <div class="col-12">
                                                            <div class="text-s font-weight-bold mb-1">
                                                                <?=$gallery?>
                                                             </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-3 text-center">
                                                        <div class="col-12">
                                                            <img src="<?=$firstFile?>" style="height:100px; max-width:100%; margin:0 auto;">
                                                        </div>                                
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <a href="../misc/gallery/<?=$folder?>.php" class="btn btn-info btn-icon-split btn-sm">
                                                                <span class="icon text-white-50">
                                                                    <i class="fas fa-link"></i>
                                                                </span>
                                                                <span class="text">Link</span>
                                                            </a>   
                                                        </div>
                                                    </div>
                                     
                            <?php
                             }
                             ?>
                             </div>
                             <?php
                         }
                         if($page->layout=="variant2"){
                        ?>
                        </div>
                        <div class="block-row">
                        <?php
                         }
                         if($page->block3_type!="n"){
                            ?>
                            <div class="block block3 <?=$page_class?>" style="background-color:<?=$page->block3_bg?> !important; color:<?=$page->block3_text?> !important;">
                            <?php
                            if($page->block3_type=="t"){
                        ?>
                        <?php
                            echo $page->block3_type;
                            ?>  
                        <?php
                            }else if($page->block3_type=="b"){
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
                                echo "</ul>";
                            }else{
                               $dir="misc/gallery/img/$page->block3_type/";
                               $images= scandir ($dir);
                               $firstFile = $dir ."/". $images[2];// because [0] = "." [1] = ".." 
                                $folder=$page->block3_type;
                                $gallery=str_replace("_"," ",$folder);
                                $gallery=ucfirst($gallery);
               
                               ?>
               
                                                    <div class="row">
                                                       <div class="col-12">
                                                           <div class="text-s font-weight-bold mb-1">
                                                               <?=$gallery?>
                                                            </div>
                                                       </div>
                                                   </div>
                                                   <div class="row my-3 text-center">
                                                       <div class="col-12">
                                                           <img src="<?=$firstFile?>" style="height:100px; max-width:100%; margin:0 auto;">
                                                       </div>                                
                                                   </div>
                                                   <div class="row">
                                                       <div class="col-12 text-center">
                                                           <a href="../misc/gallery/<?=$folder?>.php" class="btn btn-info btn-icon-split btn-sm">
                                                               <span class="icon text-white-50">
                                                                   <i class="fas fa-link"></i>
                                                               </span>
                                                               <span class="text">Link</span>
                                                           </a>   
                                                       </div>
                                                   </div>
                                    
                           <?php
                            }
                            ?>
                            </div>
                            <?php
                        }
                        if($page->layout=="default"||$page->layout=="variant2"){
                            ?>
                            </div>
                            <div class="block-row">
                            <?php
                             }
                        if($page->block4_type!="n"){
                            ?>
                            <div class="block block4 <?=$page_class?>" style="background-color:<?=$page->block4_bg?> !important; color:<?=$page->block4_text?> !important;">
                            <?php
                            if($page->block4_type=="t"){
                        ?>
                        <?php
                            echo $page->block4;
                            ?>  
                        <?php
                            }else if($page->block4_type=="b"){
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
                                echo "</ul>";
                            }else{
                                $dir="misc/gallery/img/$page->block4_type/";
                                $images= scandir ($dir);
                                $firstFile = $dir ."/". $images[2];// because [0] = "." [1] = ".." 
                                 $folder=$page->block4_type;
                                 $gallery=str_replace("_"," ",$folder);
                                 $gallery=ucfirst($gallery);
                
                                ?>
                
                                                     <div class="row">
                                                        <div class="col-12">
                                                            <div class="text-s font-weight-bold mb-1">
                                                                <?=$gallery?>
                                                             </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-3 text-center">
                                                        <div class="col-12">
                                                            <img src="<?=$firstFile?>" style="height:100px; max-width:100%; margin:0 auto;">
                                                        </div>                                
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <a href="../misc/gallery/<?=$folder?>.php" class="btn btn-info btn-icon-split btn-sm">
                                                                <span class="icon text-white-50">
                                                                    <i class="fas fa-link"></i>
                                                                </span>
                                                                <span class="text">Link</span>
                                                            </a>   
                                                        </div>
                                                    </div>
                                     
                           <?php
                            }
                            ?>
                            </div>
                            <?php
                        }
                        if($page->layout=="variant1"){
                            ?>
                            </div>
                            <div class="block-row">
                            <?php
                             }

                        if($page->block5_type!="n"){
                            ?>
                            <div class="block block5 <?=$page_class?>" style="background-color:<?=$page->block5_bg?> !important; color:<?=$page->block5_text?> !important;">
                            <?php
                            if($page->block5_type=="t"){
                        ?>
                        <?php
                            echo $page->block5;
                            ?>  
                        <?php
                            }else if($page->block5_type=="b"){
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
                                echo "</ul>";
                            }else{
                                $dir="misc/gallery/img/$page->block5_type/";
                               $images= scandir ($dir);
                               $firstFile = $dir ."/". $images[2];// because [0] = "." [1] = ".." 
                                $folder=$page->block5_type;
                                $gallery=str_replace("_"," ",$folder);
                                $gallery=ucfirst($gallery);
               
                               ?>
               
                                                    <div class="row">
                                                       <div class="col-12">
                                                           <div class="text-s font-weight-bold mb-1">
                                                               <?=$gallery?>
                                                            </div>
                                                       </div>
                                                   </div>
                                                   <div class="row my-3 text-center">
                                                       <div class="col-12">
                                                           <img src="<?=$firstFile?>" style="height:100px; max-width:100%; margin:0 auto;">
                                                       </div>                                
                                                   </div>
                                                   <div class="row">
                                                       <div class="col-12 text-center">
                                                           <a href="../misc/gallery/<?=$folder?>.php" class="btn btn-info btn-icon-split btn-sm">
                                                               <span class="icon text-white-50">
                                                                   <i class="fas fa-link"></i>
                                                               </span>
                                                               <span class="text">Link</span>
                                                           </a>   
                                                       </div>
                                                   </div>
                                    
                           <?php
                            }
                            ?>
                            </div>
                            <?php
                        }

                        if($page->block6_type!="n"){
                            ?>
                            <div class="block block6 <?=$page_class?>" style="background-color:<?=$page->block6_bg?> !important; color:<?=$page->block6_text?> !important;">
                            <?php
                            if($page->block6_type=="t"){
                        ?>
                        <?php
                            echo $page->block6;
                            ?>  
                        <?php
                            }else if($page->block6_type=="b"){
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
                                echo "</ul>";
                            }else{
                                $dir="misc/gallery/img/$page->block6_type/";
                                $images= scandir ($dir);
                                $firstFile = $dir ."/". $images[2];// because [0] = "." [1] = ".." 
                                 $folder=$page->block6_type;
                                 $gallery=str_replace("_"," ",$folder);
                                 $gallery=ucfirst($gallery);
                
                                ?>
                
                                                     <div class="row">
                                                        <div class="col-12">
                                                            <div class="text-s font-weight-bold mb-1">
                                                                <?=$gallery?>
                                                             </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-3 text-center">
                                                        <div class="col-12">
                                                            <img src="<?=$firstFile?>" style="height:100px; max-width:100%; margin:0 auto;">
                                                        </div>                                
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <a href="../misc/gallery/<?=$folder?>.php" class="btn btn-info btn-icon-split btn-sm">
                                                                <span class="icon text-white-50">
                                                                    <i class="fas fa-link"></i>
                                                                </span>
                                                                <span class="text">Link</span>
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
                            </div>
                    <div class="clearfix"></div>
                </div>
            </div>

<?php
require "admin/template/inc/footer.php";
?>