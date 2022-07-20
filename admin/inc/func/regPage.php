<?php


$idToMod="";
$type=filter_input(INPUT_GET, "type");

$idToMod = filter_input(INPUT_GET,"idToMod");
$titoloForm=$regpage_title_edit;
$operation="mod";


$stmt = $settings->showSettings();

    
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
                <input type="checkbox" name="use_name" value="1" <?=$checked_name?>> <?= $regpage_use_name?> (<b><?=$site_name?></b>)<br><br>
                <input type="checkbox" name="use_desc" value="1" <?=$checked_desc?>> <?= $regpage_use_description?> (<b><?=$site_description?></b>)<br>
                <?php
                    }
                    ?>
                    <hr>
            </div>
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
<br>



            <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">
        </form>
        
        
    </div>
</div>
</div>
</div>