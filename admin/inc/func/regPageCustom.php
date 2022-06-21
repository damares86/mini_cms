<?php

$operation = "add";
$titoloForm = $regpage_title_add;

$postToMod="";
$idToMod="";
$category_id="";
$type=filter_input(INPUT_GET, "type");

if(filter_input(INPUT_GET,"idToMod")){
    $idToMod = filter_input(INPUT_GET,"idToMod");
    $titoloForm=$regpage_title_edit;
    $operation="mod";
}

$stmt = $settings->showSettings();

$plugins->plugin_name="Post";
$plugins->showByName();
$postActive=$plugins->active;

    function is_dir_empty($dir) {
           if (!is_readable($dir)) return null; 
             return (count(scandir($dir)) == 2);
        }
?>



<!-- hyde/show boxes -->

        <script>
        $(document).ready(function(){
            $('input[name="block2[]"]').click(function(){
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".box2").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
        <script>
        $(document).ready(function(){
            $('input[name="block3[]"]').click(function(){
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".box3").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
        <script>
        $(document).ready(function(){
            $('input[name="block4[]"]').click(function(){
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".box4").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
        <script>
        $(document).ready(function(){
            $('input[name="block5[]"]').click(function(){
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".box5").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
        <script>
        $(document).ready(function(){
            $('input[name="block6[]"]').click(function(){
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".box6").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$titoloForm?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <?php
        $page->id = $idToMod;

        $page->showById();
        ?>
        <style>
            .box2{
                display: none;
            }
            .box3{
                display: none;
            }
            .box4{
                display: none;
            }
            .box5{
                display: none;
            }
            .box6{
                display: none;
            }


        </style>

        </div>
        <div class="card-body">
 
            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#infoPage">
                        <span class="icon text-white-50">
                            <i class="fas fa-fw fa-question"></i>
                        </span>
                        <span class="text"><?=$regpage_info?></span>
                    </a> <br>
             <!-- Info Modal-->
             <div class="modal fade" id="infoPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b><?=$regpage_info?></b></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body guide">
                                   <?=$regpage_desc?>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" data-dismiss="modal"><?=$txt_close?></button>
                                </div>
                            </div>
                        </div>
                    </div>
            <br>
           
            <br>

        <form id="postForm" class="form-horizontal row-fluid" action="core/mngPage.php" method="post" onsubmit="return postForm()"  enctype="multipart/form-data">
        <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php 
 


      if($operation=="mod"){ 
          ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                    <?php 
                } 
                
                ?>
            <div class="control-group">
                
                <div class="controls">
                   

<input type="hidden" name="old_page_name" value="<?= $page->page_name ?>" />
<input type="text" id="page_name" name="page_name" placeholder="<?=$regpage_name?>" value="<?=$page->page_name?>" class="span8">

<?php
                      
                       ?>
                       <input type="hidden" name="type" value="<?= $type ?>" />
                     
                </div>
            </div>
            
            <br>
            <div class="control-group">
                <label class="control-label" for="layout">
                    <?=$regpage_layout?>
                </label>
                <div class="controls">
                    <?php
                    $pageLayout=$page->layout;
                   
                    foreach (glob("template/layout/*") as $file) {
                        if( is_file($file) ){
                            $style=pathinfo($file, PATHINFO_FILENAME);
                            $checked="";
                            if ($style == $pageLayout) {
                                $checked = "checked";
                            }
                            echo "<input type='radio' id='$style' name='layout' value='$style' $checked> <img src='template/layout/img/$style.png'> &nbsp; &nbsp; &nbsp;";

                        }
                    }
                ?>

                </div>
            </div>
            <br>
            <br>
            <?php
                $display="";
                $checked="";
                if($page->header==0){
                    $display="none";
            }else{
                $display="block";
                $checked="checked";
            }


        ?>
        <script>
            function show(i) {
                document.getElementById(i).style.visibility='visible';
            }
        </script>
        <script>
            $(document).ready(function(){
            $("#changeHeader").click(function(){
                $("#uploadHeader").toggle();
            });
            });
        </script>
        <input type="checkbox" name="visualSel" value="1" id="changeHeader" <?=$checked?>> <?=$regpage_use_visual?>

<div id="uploadHeader" class="border-top border-bottom"  style="display:<?=$display?>">
<br>
            <?php
$img=$page->img;
$page_theme="";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

     extract($row);

     $page_theme=$theme;
     if(!($page->img)){
         $img="visual.jpg";
     }
?>
            <div class="control-group">
                <label class="control-label" for="file"><?=$regpage_visual?></label>
                <div class="controls">
                    <input type="file" id="myfile" name="myfile">
                    <br><br>
                    <?=$regpage_actual?> &nbsp;<img src="../uploads/img/<?=$img?>"  style="max-width:200px;">
                </div>
            </div>
            <br>
        </div>
            <br>
            <?php
}


?>
<br>
<input type="hidden" name="theme" value="<?= $page_theme ?>" />

  
            <h3><?=$regpage_block?> 1</h3><br>
            <?php
            // $checked_t1="checked";
            // $checked_g1="";
            // $checked_b1="";
                
            // if($page->block1_type=="t"){
            //     $checked_t1="checked";     
            // } else if($page->block1_type=="b"){
            //     $checked_b1="checked";     
            // } else if($page->block1_type=="n"){
            //     $checked_n1 = "checked";
            // }

        ?>
        <!-- radio button -->
        <!-- <label><input type="radio" name="block1[]" value="t1" <?=$checked_t1?>> Text block</label>
        <label><input type="radio" name="block1[]" value="g1" <?=$checked_g1?>> Gallery</label>
        <label><input type="radio" name="block1[]" value="b1" <?=$checked_b1?>> Last posts</label>
        <br><br>-->

    <!-- TEXT BOX -->
    <!--<div class="t1 box"> -->
            <textarea id="summernote" name="editor1" rows="10">   <?=$page->block1?></textarea>
            <br>
            <div class="control-group">
            <label for="block1_bg"><?=$regpage_background?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block1_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block1_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block1_text"><?=$regpage_text?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block1_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block1_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>

         <!-- GALLERY BOX -->
         <!-- <div class="g1 box p-3" style="background-color:#f8f9fc"> 
            Choose an existing gallery -->

            <?php
        //     $dir_gall="../misc/gallery/img/";
        //     $dir_root="../misc/gallery/";
        
        //         if( !is_dir($dir_gall) || is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){
        //             echo "<div class='col'><div class='alert alert-danger'>$gall_nogall</div></div>";
        //         }else{
        //             ?>
                    <!-- <select name="block1_gall"> -->
                        <?php
        //                 echo "<option value='none'>none</option>";

        //     foreach (glob("../misc/gallery/img/*") as $file) {
        //         $folder=pathinfo($file, PATHINFO_FILENAME);
        //         $gallery= str_replace("_"," ", $folder);
        //         $gallery=ucfirst($gallery);
                
        //         $images= scandir ($file);
        //         $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 

        //         $selected ="";
        //         if($page->block1_type==$folder){
        //             $selected="selected";
        //         }
        //         echo "<option value'$folder' $selected>$folder</option>";
        //     ?>

         <?php
        //     }
        // }
        
        // ?>
        <!-- </select>
        </div> -->
              
        <!-- BLOG BOX -->
        <!-- <div class="b1 box p-3" style="background-color:#f8f9fc">
             Shows the last three posts from the blog
        </div> -->
    <!-- END BLOCK 2 -->

            <br>
            <hr>
            
<!-- BLOCK 2 -->
            <br>
        <?php
            $checked_n2="checked";
            $checked_t2="";
            $checked_g2="";
            $checked_b2="";

            $type_arr = array("t","b","n");
                
            if($page->block2_type=="t"){
                $checked_t2="checked";                
                $checked_n2="";
            } else if($page->block2_type=="b"){
                $checked_b2="checked";                
                $checked_n2="";
            } else if($page->block2_type=="n"){
                $checked_n2 = "checked";
            }else if($operation=="mod"&&!in_array($page->block2_type,$type_arr)){
                $checked_g2 = "checked";
                $checked_n2 = "";
            }

            if($checked_t2=="checked"){
                ?>
            <style>
           .box2.t2{
                display:block;
            }
            </style>
            <?php
            } else if($checked_t2=="checked"){
            ?> 
            <style>
            .box2.t2{
                 display:block;
             }
             </style>
             <?php
             } else if($checked_g2=="checked"){
             ?> 
             <style>
             .box2.g2{
                  display:block;
              }
              </style>
              <?php
              } else if($checked_b2=="checked"){
              ?>
               <style>
             .box2.b2{
                  display:block;
              }
              </style>
              <?php
              }
              ?>

        <h3><?=$regpage_block?> 2</h3><br>
        <!-- radio button -->
        <label><input type="radio" name="block2[]" value="n2" <?=$checked_n2?>> <?=$regpage_none?></label>
        <label><input type="radio" name="block2[]" value="t2" <?=$checked_t2?>> <?=$regpage_text_block?></label>
        <label><input type="radio" name="block2[]" value="g2" <?=$checked_g2?>> <?=$regpage_gall?></label>
        <?php

        if($postActive==1){
        ?>
        <label><input type="radio" name="block2[]" value="b2" <?=$checked_b2?>> <?=$regpage_post?></label>
        <?php
        }
        ?>
        <br><br>
        
        <!-- EMPTY BOX -->
        <div class="n2 box2">&nbsp;</div>

        <!-- TEXT BOX -->
        <div class="t2 box2">
            <textarea id="summernote2" name="editor2" rows="10" class="summernote position-absolute">   <?=$page->block2?></textarea>

            <br>


        </div>

         <!-- GALLERY BOX -->
         <div class="g2 box2 p-3" style="background-color:#f8f9fc"> 
         <?=$regpage_choose_gall?>
            <?php
            $dir_gall="../misc/gallery/img/";
            $dir_root="../misc/gallery/";
                if( !is_dir($dir_gall) || is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){
                    echo "<div class='col'><div class='alert alert-danger'>$gall_nogall</div></div>";
                }else{
                    ?>
                    <select name="block2_gall">
                        <?php
                        echo "<option value='none'>none</option>";

            foreach (glob("../misc/gallery/img/*") as $file) {
                $folder=pathinfo($file, PATHINFO_FILENAME);
                $gallery= str_replace("_"," ", $folder);
                $gallery=ucfirst($gallery);
                
                $images= scandir ($file);
                $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 

                $selected ="";
                if($page->block2_type==$folder){
                    $selected="selected";
                }
                echo "<option value'$folder' $selected>$gallery</option>";
            ?>

        <?php
            }
        }
        
        ?>
        </select>
        </div>
              
        <!-- BLOG BOX -->
        <div class="b2 box2 p-3" style="background-color:#f8f9fc">
             <?=$regpage_post_desc?>
        </div>
    <!-- END BLOCK 2 -->
    <br>
    <div class="control-group">
            <label for="block2_bg"><?=$regpage_background?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block2_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block2_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block2_text"><?=$regpage_text?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block2_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block2_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>
<hr>

<!-- BLOCK 3 -->
<br>
        <?php
            $checked_n3="checked";
            $checked_t3="";
            $checked_g3="";
            $checked_b3="";

            $type_arr = array("t","b","n");
                
            if($page->block3_type=="t"){
                $checked_t3="checked";                
                $checked_n3="";
            } else if($page->block3_type=="b"){
                $checked_b3="checked";                
                $checked_n3="";
            } else if($page->block3_type=="n"){
                $checked_n3 = "checked";
            }else if($operation=="mod"&&!in_array($page->block3_type,$type_arr)){
                $checked_g3 = "checked";
                $checked_n3 = "";
            }

            if($checked_t3=="checked"){
                ?>
            <style>
           .box3.t3{
                display:block;
            }
            </style>
            <?php
            } else if($checked_t3=="checked"){
            ?> 
            <style>
            .box3.t3{
                 display:block;
             }
             </style>
             <?php
             } else if($checked_g3=="checked"){
             ?> 
             <style>
             .box3.g3{
                  display:block;
              }
              </style>
              <?php
              } else if($checked_b3=="checked"){
              ?>
               <style>
             .box3.b3{
                  display:block;
              }
              </style>
              <?php
              }
              ?>

        <h3><?=$regpage_block?> 3</h3><br>
        <!-- radio button -->
        <label><input type="radio" name="block3[]" value="n3" <?=$checked_n3?>> <?=$regpage_none?></label>
        <label><input type="radio" name="block3[]" value="t3" <?=$checked_t3?>> <?=$regpage_text_block?></label>
        <label><input type="radio" name="block3[]" value="g3" <?=$checked_g3?>> <?=$regpage_gall?></label>
        <?php

        if($postActive==1){
        ?>
        <label><input type="radio" name="block3[]" value="b3" <?=$checked_b3?>> <?=$regpage_post?></label>
        <?php
        }
        ?>
        <br><br>
        
        <!-- EMPTY BOX -->
        <div class="n3 box3">&nbsp;</div>

        <!-- TEXT BOX -->
        <div class="t3 box3">

            <br>
            <textarea id="summernote3" name="editor3" rows="10">   <?=$page->block3?></textarea>

            <br>
           
        </div>

         <!-- GALLERY BOX -->
         <div class="g3 box3 p-3" style="background-color:#f8f9fc"> 
         <?=$regpage_choose_gall?>

            <?php
            $dir_gall="../misc/gallery/img/";
            $dir_root="../misc/gallery/";
                if( !is_dir($dir_gall) || is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){
                    echo "<div class='col'><div class='alert alert-danger'>$gall_nogall</div></div>";
                }else{
                    ?>
                    <select name="block3_gall">
                        <?php
                        echo "<option value='none'>none</option>";

            foreach (glob("../misc/gallery/img/*") as $file) {
                $folder=pathinfo($file, PATHINFO_FILENAME);
                $gallery= str_replace("_"," ", $folder);
                $gallery=ucfirst($gallery);
                
                $images= scandir ($file);
                $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 

                $selected ="";
                if($page->block3_type==$folder){
                    $selected="selected";
                }
                echo "<option value'$folder' $selected>$gallery</option>";
            ?>

        <?php
            }
        }
        
        ?>
        </select>
        </div>
              
        <!-- BLOG BOX -->
        <div class="b3 box3 p-3" style="background-color:#f8f9fc">
        <?=$regpage_post_desc?>
        </div>
        <br>
        <div class="control-group">
            <label for="block3_bg"><?=$regpage_background?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block3_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block3_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block3_text"><?=$regpage_text?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block3_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block3_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>
    <!-- END BLOCK 3 -->

<hr>

<!-- BLOCK 4 -->
<br>
        <?php
            $checked_n4="checked";
            $checked_t4="";
            $checked_g4="";
            $checked_b4="";

            $type_arr = array("t","b","n");
                
            if($page->block4_type=="t"){
                $checked_t4="checked";                
                $checked_n4="";
            } else if($page->block4_type=="b"){
                $checked_b4="checked";                
                $checked_n4="";
            } else if($page->block4_type=="n"){
                $checked_n4 = "checked";
            }else if($operation=="mod"&&!in_array($page->block4_type,$type_arr)){
                $checked_g4 = "checked";
                $checked_n4 = "";
            }

            if($checked_t4=="checked"){
                ?>
            <style>
           .box4.t4{
                display:block;
            }
            </style>
            <?php
            } else if($checked_t4=="checked"){
            ?> 
            <style>
            .box4.t4{
                 display:block;
             }
             </style>
             <?php
             } else if($checked_g4=="checked"){
             ?> 
             <style>
             .box4.g4{
                  display:block;
              }
              </style>
              <?php
              } else if($checked_b4=="checked"){
              ?>
               <style>
             .box4.b4{
                  display:block;
              }
              </style>
              <?php
              }
              ?>
              
        <h3><?=$regpage_block?> 4</h3><br>
        <!-- radio button -->
        <label><input type="radio" name="block4[]" value="n4" <?=$checked_n4?>> <?=$regpage_none?></label>
        <label><input type="radio" name="block4[]" value="t4" <?=$checked_t4?>> <?=$regpage_text_block?></label>
        <label><input type="radio" name="block4[]" value="g4" <?=$checked_g4?>> <?=$regpage_gall?></label>
        <?php

        if($postActive==1){
        ?>
        <label><input type="radio" name="block4[]" value="b4" <?=$checked_b4?>> <?=$regpage_post?></label>
        <?php
        }
        ?>
        <br><br>
        
        <!-- EMPTY BOX -->
        <div class="n4 box4">&nbsp;</div>

        <!-- TEXT BOX -->
        <div class="t4 box4">

            <br>
            <textarea id="summernote4" name="editor4" rows="10">   <?=$page->block4?></textarea>

            <br>

        </div>

           <!-- GALLERY BOX -->
           <div class="g4 box4 p-3" style="background-color:#f8f9fc"> 
           <?=$regpage_choose_gall?>

            <?php
            $dir_gall="../misc/gallery/img/";
            $dir_root="../misc/gallery/";
                if( !is_dir($dir_gall) || is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){
                    echo "<div class='col'><div class='alert alert-danger'>$gall_nogall</div></div>";
                }else{
                    ?>
                    <select name="block4_gall">
                        <?php
                        echo "<option value='none'>none</option>";

            foreach (glob("../misc/gallery/img/*") as $file) {
                $folder=pathinfo($file, PATHINFO_FILENAME);
                $gallery= str_replace("_"," ", $folder);
                $gallery=ucfirst($gallery);
                
                $images= scandir ($file);
                $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 

                $selected ="";
                if($page->block4_type==$folder){
                    $selected="selected";
                }
                echo "<option value'$folder' $selected>$gallery</option>";
            ?>

        <?php
            }
        }
        
        ?>
        </select>
        </div>
              
        <!-- BLOG BOX -->
        <div class="b4 box4 p-3" style="background-color:#f8f9fc">
            <?=$regpage_post_desc?>
        </div>

        <br>
        <div class="control-group">
            <label for="block4_bg"><?=$regpage_background?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block4_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block4_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block4_text"><?=$regpage_text?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block4_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block4_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>
    <!-- END BLOCK 4 -->

<hr>

<!-- BLOCK 5 -->
<br>
        <?php
            $checked_n5="checked";
            $checked_t5="";
            $checked_g5="";
            $checked_b5="";

            $type_arr = array("t","b","n");
                
            if($page->block5_type=="t"){
                $checked_t5="checked";                
                $checked_n5="";
            } else if($page->block5_type=="b"){
                $checked_b5="checked";                
                $checked_n5="";
            } else if($page->block5_type=="n"){
                $checked_n5 = "checked";
            }else if($operation=="mod"&&!in_array($page->block5_type,$type_arr)){
                $checked_g5 = "checked";
                $checked_n5 = "";
            }

            if($checked_t5=="checked"){
                ?>
            <style>
           .box5.t5{
                display:block;
            }
            </style>
            <?php
            } else if($checked_t5=="checked"){
            ?> 
            <style>
            .box5.t5{
                 display:block;
             }
             </style>
             <?php
             } else if($checked_g5=="checked"){
             ?> 
             <style>
             .box5.g5{
                  display:block;
              }
              </style>
              <?php
              } else if($checked_b5=="checked"){
              ?>
               <style>
             .box5.b5{
                  display:block;
              }
              </style>
              <?php
              }
              ?>

<h3><?=$regpage_block?> 5</h3><br>
        <!-- radio button -->
        <label><input type="radio" name="block5[]" value="n5" <?=$checked_n5?>> <?=$regpage_none?></label>
        <label><input type="radio" name="block5[]" value="t5" <?=$checked_t5?>> <?=$regpage_text_block?></label>
        <label><input type="radio" name="block5[]" value="g5" <?=$checked_g5?>> <?=$regpage_gall?></label>
        <?php

        if($postActive==1){
        ?>
        <label><input type="radio" name="block5[]" value="b5" <?=$checked_b5?>> <?=$regpage_post?></label>
        <?php
        }
        ?>
        <br><br>
        
        <!-- EMPTY BOX -->
        <div class="n5 box5">&nbsp;</div>

        <!-- TEXT BOX -->
        <div class="t5 box5">

            <br>

            <textarea id="summernote5" name="editor5" rows="10">   <?=$page->block5?></textarea>

            <br>
    
        </div>

           <!-- GALLERY BOX -->
           <div class="g5 box5 p-3" style="background-color:#f8f9fc"> 
           <?=$regpage_choose_gall?>

            <?php
            $dir_gall="../misc/gallery/img/";
            $dir_root="../misc/gallery/";
                if( !is_dir($dir_gall) || is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){
                    echo "<div class='col'><div class='alert alert-danger'>$gall_nogall</div></div>";
                }else{
                    ?>
                    <select name="block5_gall">
                        <?php
                        echo "<option value='none'>none</option>";

            foreach (glob("../misc/gallery/img/*") as $file) {
                $folder=pathinfo($file, PATHINFO_FILENAME);
                $gallery= str_replace("_"," ", $folder);
                $gallery=ucfirst($gallery);
                
                $images= scandir ($file);
                $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 

                $selected ="";
                if($page->block5_type==$folder){
                    $selected="selected";
                }
                echo "<option value'$folder' $selected>$gallery</option>";
            ?>

        <?php
            }
        }
        
        ?>
        </select>
        </div>
              
        <!-- BLOG BOX -->
        <div class="b5 box5 p-3" style="background-color:#f8f9fc">
        <?=$regpage_post_desc?>
        </div>

        <br>
        <div class="control-group">
            <label for="block5_bg"><?=$regpage_background?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block5_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block5_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block5_text"><?=$regpage_text?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block5_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block5_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>
    <!-- END BLOCK 5 -->

<hr>

<!-- BLOCK 6 -->
<br>
        <?php
            $checked_n6="checked";
            $checked_t6="";
            $checked_g6="";
            $checked_b6="";

            $type_arr = array("t","b","n");
                
            if($page->block6_type=="t"){
                $checked_t6="checked";                
                $checked_n6="";
            } else if($page->block6_type=="b"){
                $checked_b6="checked";                
                $checked_n6="";
            } else if($page->block6_type=="n"){
                $checked_n6 = "checked";
            }else if($operation=="mod"&&!in_array($page->block6_type,$type_arr)){
                $checked_g6 = "checked";
                $checked_n6 = "";
            }

            if($checked_t6=="checked"){
                ?>
            <style>
           .box6.t6{
                display:block;
            }
            </style>
            <?php
            } else if($checked_t6=="checked"){
            ?> 
            <style>
            .box6.t6{
                 display:block;
             }
             </style>
             <?php
             } else if($checked_g6=="checked"){
             ?> 
             <style>
             .box6.g6{
                  display:block;
              }
              </style>
              <?php
              } else if($checked_b6=="checked"){
              ?>
               <style>
             .box6.b6{
                  display:block;
              }
              </style>
              <?php
              }             


        ?>
        <h3><?=$regpage_block?> 6</h3><br>
        <!-- radio button -->
        <label><input type="radio" name="block6[]" value="n6" <?=$checked_n6?>> <?=$regpage_none?></label>
        <label><input type="radio" name="block6[]" value="t6" <?=$checked_t6?>> <?=$regpage_text_block?></label>
        <label><input type="radio" name="block6[]" value="g6" <?=$checked_g6?>> <?=$regpage_gall?></label>
        <?php

        if($postActive==1){
        ?>
        <label><input type="radio" name="block6[]" value="b6" <?=$checked_b6?>> <?=$regpage_post?></label>
        <?php
        }
        ?>
        <br><br>
        
        <!-- EMPTY BOX -->
        <div class="n6 box6">&nbsp;</div>

        <!-- TEXT BOX -->
        <div class="t6 box6">

            <br>

            <textarea id="summernote6" name="editor6" rows="10">   <?=$page->block6?></textarea>

            <br>

        </div>

    <!-- GALLERY BOX -->
    <div class="g6 box6 p-3" style="background-color:#f8f9fc"> 
            <?=$regpage_choose_gall?>

            <?php
            $dir_gall="../misc/gallery/img/";
            $dir_root="../misc/gallery/";
                if( !is_dir($dir_gall) || is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){
                    echo "<div class='col'><div class='alert alert-danger'>$gall_nogall</div></div>";
                }else{
                    ?>
                    <select name="block6_gall">
                        <?php
                        echo "<option value='none'>none</option>";

            foreach (glob("../misc/gallery/img/*") as $file) {
                $folder=pathinfo($file, PATHINFO_FILENAME);
                $gallery= str_replace("_"," ", $folder);
                $gallery=ucfirst($gallery);
                
                $images= scandir ($file);
                $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 

                $selected ="";
                if($page->block6_type==$folder){
                    $selected="selected";
                }
                echo "<option value'$folder' $selected>$gallery</option>";
            ?>

        <?php
            }
        }
        
        ?>
        </select>
        </div>
              
        <!-- BLOG BOX -->
        <div class="b6 box6 p-3" style="background-color:#f8f9fc">
        <?=$regpage_post_desc?> 
        </div>

        <br>
        <div class="control-group">
            <label for="block6_bg"><?=$regpage_background?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block6_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block6_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block6_text"><?=$regpage_text?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block6_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block6_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>
    <!-- END BLOCK 6 -->

<hr>

                        <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">
        </form>
        
        
    </div>
</div>
</div>
</div>