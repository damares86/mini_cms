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



<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$titoloForm?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
  

        </div>
        <?php
        $page->id = $idToMod;

        $page->showById();

        // if(!isset($_SESSION["sess_old_page_name"])){
        //     $_SESSION["sess_old_page_name"]= $page->page_name;
        // }

        ?>

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

        <form id="postForm" class="form-horizontal row-fluid" action="core/mngPage.php" method="post" enctype="multipart/form-data">



<?php
        $counter="1";
if(filter_input(INPUT_GET,"count")){
    $counter=filter_input(INPUT_GET,"count");
}
$_SESSION['counter']=$counter;
if($operation=="add"){
    // $page->page_name="";
    // $page->layout="";
    // $page->img="";
    if(!isset($_REQUEST['more'])){
        $page->destroyCheckSessVar();
    }


    if(isset($_REQUEST['more'])&&$_REQUEST['more']=="yes"){
        $page->page_name=$_SESSION['sess_page_name'];
        $page->layout=$_SESSION['sess_layout'];
        $page->header=$_SESSION['sess_header'];
        // $page->img=$_SESSION['sess_img'];
    }
}else if($operation=="mod"&&!isset($_REQUEST['more'])){
        $page->destroyCheckSessVar();
        $_SESSION["sess_old_page_name"]= $page->page_name;
        $name=$page->page_name;
        $name=preg_replace("/\s+/", "_", $name);
        $name=strtolower($name);

        $json_file = 'inc/pages/'.$name.'.json';
        $data = file_get_contents($json_file);
        $json_arr = json_decode($data, true);

        $page-> modCheckSessVar($json_arr);
}
?>



        <input type="hidden" name="operation" value="<?= $operation ?>" />
               
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
            
            <div class="control-group">
                
                <div class="controls">
                    <strong><?php echo $_SESSION["sess_old_page_name"] ?></strong>
                    <input type="hidden" name="old_page_name" value="<?= $_SESSION["sess_old_page_name"] ?>" />

                    <?php
                        if($operation=="mod"&&$page->page_name == "index"){
                            print_r("ciao");
                            exit;
                    ?>
                        <input type="hidden" name="page_name" value="<?= $page->page_name?>" />
                    <?php
                        }else{
                    ?>
                    <input type="text" id="page_name" name="page_name" placeholder="<?=$regpage_name?>" value="<?=$_SESSION['sess_page_name']?>" class="span8">
                    <?php
                        }
                    ?>
                    
                    <input type="hidden" name="no_mod" value="<?= $page->no_mod ?>" />
            
                       <input type="hidden" name="type" value="custom" />
                     
                </div>
            </div>
            
            <br>

            <div class="control-group">
                <label class="control-label" for="layout">
                    <?=$regpage_layout?>
                </label>
                <div class="controls">
                    <?php
                    $pageLayout=$_SESSION['sess_layout'];
                   
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
            <div class="control-group">

            <hr>
            <?php
                $checked_name="checked";
                $checked_desc="checked";
                if(isset($_SESSION['sess_use_name'])&&$_SESSION['sess_use_name']==0){
                    $checked_name="";
                }

                if(isset($_SESSION['sess_use_desc'])&&$_SESSION['sess_use_desc']==0){
                    $checked_desc="";
                }

    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                    extract($row);
            ?>
            <input type="checkbox" name="use_name" value="1" <?=$checked_name?>> Use site name (<b><?=$site_name?></b>)<br><br>
            <input type="checkbox" name="use_desc" value="1" <?=$checked_desc?>> Use site description (<b><?=$site_description?></b>)<br>
            <?php
                // }
                ?>
                <hr>
            </div>
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

// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

//      extract($row);

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
<?php

////////////////////////////////////////////////////////

// SESSION VARIABILES


for($i=1;$i<=$counter;$i++){    
    echo "<style>";
    echo "\n";        
    echo ".box$i{";
    echo "\n";        
    echo "display: none;";
    echo "\n";        
    echo "}";
    echo "\n";        
    echo "</style>";
    echo "\n";        
    
    ?>
            
        
            <?php
                if($i!=1){
            ?>
            <span style="font-weight:bold; font-size: 1.5em;"><?=$regpage_block?> <?=$i?></span> &nbsp; &nbsp;
            <button type="submit" class="btn btn-danger btn-icon-split" name="rmBlock" value="<?=$i?>">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Rimuovi blocco</span>
            </button><br><br>
            <!-- <button type="submit" class="btn btn-primary d-inline" name="rmBlock" value="<?=$i?>">Rimuovi blocco</button><br><br> -->
            <?php
                }else{
            ?>
                <span style="font-weight:bold; font-size: 1.5em;"><?=$regpage_block?> <?=$i?></span><br>
            <?php
                }
            ?>


    <?php
    $var="block$i";


        echo "<script>";
        echo "\n";        
        echo "$(document).ready(function(){";
        echo "\n";        
        echo '$(\'input[name="block'.$i.'[]"]\').click(function(){';
        echo "\n";        
        echo "var inputValue = $(this).attr(\"value\");";
        echo "\n";        
        echo "var targetBox = $(\".\" + inputValue);";
        echo "\n";        
        echo "$('.box$i').not(targetBox).hide();";
        echo "\n";        
        echo "$(targetBox).show();";
        echo "\n";        
        echo "});";
        echo "\n";        
        echo "});";
        echo "\n";        
        echo "</script>";
        echo "\n";        


        $none="checked_n$i";
        $text="checked_t$i";
        $gall="checked_g$i";
        $blog="checked_b$i";
        $page_class="page";

        $block_type='block'.$i.'_type';
		$sess_type="sess_type_$i";
        $page->$block_type=$_SESSION[''.$sess_type.''];
        
        $$none="checked";
        $$text="";
        $$gall="";
        $$blog="";
        
        $type_arr = array("t","b","n");
        if($operation=="mod"||(isset($_SESSION[''.$sess_type.'']))){
        if($page->$block_type=="t"){
            $$text="checked";                
            $$none="";
        } else if($page->$block_type=="b"){
            $$blog="checked";                
            $$none="";
        } else if($page->$block_type=="n"){
            $$none = "checked";
        }else if(!in_array($page->$block_type,$type_arr)){
            $$gall = "checked";
            $$none = "";
        }
    }

            if($$text=="checked"){
              
                echo "<style>";
                echo "\n";        
                echo ".box$i.t$i{";
                echo "\n";        
                echo "display:block;";
                echo "\n";        
                echo "}";
                echo "\n";        
                echo "</style>";
            } else if($$gall=="checked"){
                echo "<style>";
                echo "\n";        
                echo ".box$i.g$i{";
                echo "\n";        
                echo "display:block;";
                echo "\n";        
                echo "}";
                echo "\n";        
                echo "</style>";
              } else if($blog=="checked"){
                echo "<style>";
                echo "\n";        
                echo ".box$i.b$i{";
                echo "\n";        
                echo "display:block;";
                echo "\n";        
                echo "}";
                echo "\n";        
                echo "</style>";
              }
              ?>

        <!-- radio button -->
        <label><input type="radio" name="block<?=$i?>[]" value="n<?=$i?>" <?=$$none?>> <?=$regpage_none?></label>
        <label><input type="radio" name="block<?=$i?>[]" value="t<?=$i?>" <?=$$text?>> <?=$regpage_text_block?></label>
        <label><input type="radio" name="block<?=$i?>[]" value="g<?=$i?>" <?=$$gall?>> <?=$regpage_gall?></label>
        <?php

        if($postActive==1){
        ?>
        <label><input type="radio" name="block<?=$i?>[]" value="b<?=$i?>" <?=$$blog?>> <?=$regpage_post?></label>
        <?php
        }
        ?>
        <br><br>
        
        <!-- EMPTY BOX -->
        <div class="n<?=$i?> box<?=$i?>">&nbsp;</div>

        <!-- TEXT BOX -->
        <div class="t<?=$i?> box<?=$i?>">
            <?php
            $name="block$i";
            $page->$name=$_SESSION['sess_editor'.$i.''];
            ?>
            <textarea id="summernote<?=$i?>" name="editor<?=$i?>" rows="10">   <?=$page->$var?></textarea>
            <br>
            


        </div>

         <!-- GALLERY BOX -->
         <div class="g<?=$i?> box<?=$i?> p-3" style="background-color:#f8f9fc"> 
         <?=$regpage_choose_gall?>
            <?php
            $dir_gall="../misc/gallery/img/";
            $dir_root="../misc/gallery/";
                if( !is_dir($dir_gall) || is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){
                    echo "<div class='col'><div class='alert alert-danger'>$gall_nogall</div></div>";
                }else{
                    ?>
                    <select name="block<?=$i?>_gall">
                        <?php
                        echo "<option value='none'>none</option>";

            foreach (glob("../misc/gallery/img/*") as $file) {
                $folder=pathinfo($file, PATHINFO_FILENAME);
                $gallery= str_replace("_"," ", $folder);
                $gallery=ucfirst($gallery);
                
                $images= scandir ($file);
                $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 

                $selected ="";
                if($page->$block_type==$folder){
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
        <div class="b<?=$i?> box<?=$i?> p-3" style="background-color:#f8f9fc">
             <?=$regpage_post_desc?>
        </div>



<?php
        $block_bg='block'.$i.'_bg';
		$sess_bg="sess_bg_$i";
        $page->$block_bg=$_SESSION[''.$sess_bg.''];

        $block_text='block'.$i.'_text';
		$sess_text="sess_text_$i";
        $page->$block_text=$_SESSION[''.$sess_text.''];
?>
<br>
<div class="control-group">
            <label for="block<?=$i?>_bg"><?=$regpage_background?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block<?=$i?>_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->$block_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block<?=$i?>_text"><?=$regpage_text?></label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block<?=$i?>_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->$block_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>
  
            <hr>
            <br>
        
        <?php
}
?>
<input type="hidden" name="counter" value="<?= $counter ?>" />




<button type="submit" class="btn btn-success btn-icon-split" name="addBlock" value="<?=$i?>">
    <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
    </span>
    <span class="text">Aggiungi un blocco</span>
</button>
<br><br>



            
            


            <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">
        </form>
        
        
    </div>
</div>
</div>
</div>