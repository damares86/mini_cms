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
                <div class="block block1 <?=$page_class?>" style="background-color:<?=$page->block1_bg?> !important; color:<?=$page->block1_text?> !important;">
                        <?php
                        echo $page->block1;
                        ?>            
                    </div>
                    <?php 
                         if($page->block2_type!="n"){
                             if($page->block2_type=="t"){
                         ?>
                         <div class="block block2 <?=$page_class?>" style="background-color:<?=$page->block2_bg?> !important; color:<?=$page->block2_text?> !important;">
                         <?php
                             echo $page->block2;
                             ?>  
                         </div>
                         <?php
                             }else if($page->block2_type=="b"){
                                 $stmt1=$post->showLastPosts();
                                 echo "<ul>";
                                 while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
        
                                    extract($row);
                                    ?>
                                    <li><b><?=$title?></b><br>
                                        <?= $modified?>
                                    </li>
                                    
                                    <?php
                                 }
                                 echo "</ul>";
                             }else{
                                $dir="misc/gallery/img/$page->block2_type/";
                                $images= scandir ($dir);
                                $firstFile = $dir ."/". $images[2];// because [0] = "." [1] = ".." 
                            
                
                                ?>
                
                                        <div class="col-12 col-md-4 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-12">
                                                            <div class="text-s font-weight-bold text-success text-uppercase mb-1">
                                                                <?=$gallery?></div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
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
                                                </div>
                                            </div>
                                        </div>
                            <?php
                             }
                         }
                    if($page->block3){
                    ?> 
                    <div class="block block3 <?=$page_class?>" style="background-color:<?=$page->block3_bg?> !important; color:<?=$page->block3_text?> !important;">
                    <?php
                        echo $page->block3;
                        ?>  
                    </div>
                    <?php
                    }
                    if($page->block4){
                    ?>
                    <div class="block block4 <?=$page_class?>" style="background-color:<?=$page->block4_bg?> !important; color:<?=$page->block4_text?> !important;">
                    <?php
                        echo $page->block4;
                        ?>  
                    </div>
                    <?php
                    }
                    if($page->block5){
                    ?>
                    <div class="block block5 <?=$page_class?>" style="background-color:<?=$page->block5_bg?> !important; color:<?=$page->block5_text?> !important;">
                    <?php
                        echo $page->block5;
                        ?>  
                    </div><?php
                    }
                    if($page->block6){
                    ?>
                    <div class="block block6 <?=$page_class?>" style="background-color:<?=$page->block6_bg?> !important; color:<?=$page->block6_text?> !important;">
                    <?php
                        echo $page->block6;
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