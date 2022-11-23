<?php


$idToMod="";
$type=filter_input(INPUT_GET, "type");

$idToMod = filter_input(INPUT_GET,"idToMod");
$titoloForm=$regpage_title_edit;
$operation="mod";


$stmt = $settings->showSettings();

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
        <?php
        $page->id = $idToMod;

        $page->showByIdDefault();
        ?>
      

        </div>
        <div class="card-body">
 
            <!-- <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#infoPage">
                        <span class="icon text-white-50">
                            <i class="fas fa-fw fa-question"></i>
                        </span>
                        <span class="text"><?=$regpage_info?></span>
                    </a> <br>
                    
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
                    </div> -->
   

        <form id="postForm" class="form-horizontal row-fluid" action="core/mngPage.php" method="post" onsubmit="return postForm()"  enctype="multipart/form-data">
        <input type="hidden" name="operation" value="<?= $operation ?>" />
               
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
            
            <div class="control-group">
                
                <div class="controls">

                    <strong><?= $page->page_name ?></strong>
                    <input type="hidden" name="page_name" value="<?= $page->page_name ?>" />
                       <input type="hidden" name="type" value="<?= $type ?>" />
                     
                </div>
            </div>
            
            <br>
            <!-- <div class="control-group">

                <hr>
                <?php
                    // $checked_name="checked";
                    // $checked_desc="checked";
                    // if(isset($_SESSION['sess_use_name'])&&$_SESSION['sess_use_name']==0){
                    //     $checked_name="";
                    // }

                    // if(isset($_SESSION['sess_use_desc'])&&$_SESSION['sess_use_desc']==0){
                    //     $checked_desc="";
                    // }


                    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                    //     extract($row);
                ?>
                 <input type="checkbox" name="use_name" value="1" <?=$checked_name?>> <?= $regpage_use_name?> (<b><?=$site_name?></b>)<br><br>
                <input type="checkbox" name="use_desc" value="1" <?=$checked_desc?>> <?= $regpage_use_description?> (<b><?=$site_description?></b>)<br> -->
                <?php
                    // }
                    ?>
                    <!-- <hr>
            </div> -->
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

<div id="uploadHeader" class="border-bottom"  style="display:<?=$display?>">
<br>

<?php
            
            $img=$page->img;
            $page_theme="";
            
            $checkedImg="";
            $checkedGall="";
            
            $box_name="";
            if(!isset($img)||pathinfo($img, PATHINFO_EXTENSION)){
                $checkedGall="";
                $checkedImg="checked";
                $box_name=".visual_img";
            }else{
                $checkedGall="checked";
                $checkedImg="";
                $box_name=".visual_gall";
            }
            // print_r($_SESSION['sess_gall_select']);
            // exit;
            ?>
            
            
            <label><input type="radio" name="visual[]" value="visual_img" <?=$checkedImg?>> Immagine </label>
            <label><input type="radio" name="visual[]" value="visual_gall" <?=$checkedGall?>> Galleria </label>
            <br><br>
            
            <style>
            .box_visual{display:none};
            </style>
            
            <script>
            $(document).ready(function(){
            $('input[name="visual[]"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $('.box_visual').not(targetBox).hide();
            $(targetBox).show();
            });
            });
            </script>
            
            <style>
            <?=$box_name?> {display: block;}
            </style>
            
            <div class="box_visual visual_img">
                
            <?php
                //  $page_theme=$theme;
                if(pathinfo($page->img, PATHINFO_EXTENSION)){
                    $img=$page->img;
                }else{
                    $img="visual.jpg";
                }
             
            ?>
                        <div class="control-group">
                            <label class="control-label" for="file"><?=$regpage_visual?></label>
                            <div class="controls">
                                <input type="file" id="myfile" name="myfile">
                                <br><br>
                                <?=$regpage_actual?> &nbsp;<img src="../uploads/img/<?=$img?>"  style="max-width:200px;">
            
                                <input type="hidden" name="actual_image" value="<?= $img ?>" />
            
                            </div>
                        </div>
                        <br>
                        </div>
            
                    <div class="box_visual visual_gall">
                        <div class="control-group">
                            <label class="control-label" for="file"><?=$regpage_choose_gall?></label>
                    
                                <?php
                                $dir_gall="../misc/gallery/img/";
                                $dir_root="../misc/gallery/";
                 
                                    if( !is_dir($dir_gall) || is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){
                                        echo "<div class='col'><div class='alert alert-danger'>$gall_nogall</div></div>";
                                    }else{
                                        ?>
                                        <select name="visual_gallery">
                                            <?php
                                            echo "<option value='none'>none</option>";
            
                                foreach (glob("../misc/gallery/img/*") as $file) {
                                    $folder=pathinfo($file, PATHINFO_FILENAME);
                                    $gallery= str_replace("_"," ", $folder);
                                    $gallery=ucfirst($gallery);
                                    
                                    $images= scandir ($file);
                                    $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 
            
                                    $selected ="";
                                    if($page->$block_type==$folder||$_SESSION['sess_img']==$gallery){
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
                    </div>
               
            <br>
        </div>
        <br>
        <?php
        if($idToMod==2){
            $json_file = 'inc/pages/contact.json';
            $data = file_get_contents($json_file);
            $json_arr = json_decode($data, true);
        ?>

            <div class="control-group">
                <label class="control-label" for="maps"><?=$regpage_maps?></label>
                <div class="controls">
                    <textarea id="maps" name="maps" rows="3" cols="50" placeholder="Posizione sulla mappa" value="" >
                        <?=  $json_arr['maps']?>
                    </textarea>&nbsp; &nbsp; 
                    <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#infoMaps">
                        <i class="fa fa-question-circle"></i>
                    </a>
                    
                </div>
            </div>
            <br>
        <hr><br>

            <div class="control-group">
                <div class="controls">
                    <h4><?=$regpage_contacts?></h4>
                    <textarea id="editor1" name="editor1" rows="10">
                        <?=  $json_arr['contacts']?>
                    </textarea>
                </div>
            </div>

            <!-- Info Modal-->
            <div class="modal fade" id="infoMaps" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b><?=$regpage_maps_title?></b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body guide">
                            <?=$regpage_maps_desc?>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" data-dismiss="modal"><?=$txt_close?></button>
                        </div>
                    </div>
                </div>
            </div>


        <?php
        }
        ?>


            <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">
        </form>
        
        
    </div>
</div>
</div>
</div>