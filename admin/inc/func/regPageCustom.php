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

                ////////////////////////////////////////////////////////

                // SESSION VARIABILES

                $counter="1";
                if(filter_input(INPUT_GET,"count")){
                    $counter=filter_input(INPUT_GET,"count");
                }

                if($operation=="add"){
                    // $page->page_name="";
                    // $page->layout="";
                    // $page->img="";


                    if(isset($_REQUEST['more'])&&$_REQUEST['more']=="yes"){
                        $page->page_name=$_SESSION['sess_page_name'];
                        $page->layout=$_SESSION['sess_layout'];
                        $page->img=$_SESSION['sess_img'];
                    }
                }


                for($i=1;$i<=$counter;$i++){    
                    
                    echo "Blocco $i <br>";
                    $var="block$i";
                    $var_b="";
                    // $$var="ok $i";
                    // echo $$var."<br>";
                    if(isset($_REQUEST['more'])&&$_REQUEST['more']=="yes"){
                        // $var_b="content$i";
                        $var_b_session="sess_block$i";
                        // $$var_b="";
                        $var_b = ($_SESSION[''.$var_b_session.'']);
                        // echo $$var_b."<br>";
                    }
                    ?>
                        <input type="text" class="form-control" id="<?=$var?>" name="<?=$var?>" value="<?= $var_b ?>">
                        <input type="hidden" name="counter" value="<?= $counter ?>" />

                    <?php
                }
            ?>

<input type="submit" class="btn btn-primary" name="addBlock" value="Aggiungi blocco">
<br><br>
<input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">

        </form>
            <?php

                exit;
            ?>





        <input type="hidden" name="operation" value="<?= $operation ?>" />
               
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
            
            <div class="control-group">
                
                <div class="controls">

                    <strong><?= $page->page_name ?></strong>
                    <input type="hidden" name="page_name" value="<?= $page->page_name ?>" />
                    <input type="hidden" name="old_page_name" value="<?= $page->page_name ?>" />
                    <input type="hidden" name="no_mod" value="<?= $page->no_mod ?>" />
            
                       <input type="hidden" name="type" value="<?= $type ?>" />
                     
                </div>
            </div>
            
            <br>
            <?php
                if($idToMod==1){
         
            ?>
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
            <?php
                }
            ?>
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

            

            <br>
            <hr>
            
<!-- <button id="btnAdd">Add row</button>
<br><br>

    
            <script>
var count=2;
$("#btnAdd").click(function(){
  
  $("#postForm").append(addNewRow(count));
  count++;

});

function addNewRow(count){
  var newrow='<!-- BLOCK '+count+' -->'+
            '<br>'+
            'ciao'+count+'';
  return newrow;
}
</script> -->

            <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">
        </form>
        
        
    </div>
</div>
</div>
</div>