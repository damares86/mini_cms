<?php
// MODIFICARE SU LOCALE !!!!!!!!!!!!!!!!!!!!

$operation = "add";
$titolo_form = "Upload photo";
$name ="";
$gallName="";

if(filter_input(INPUT_GET, "name")){
    $name = filter_input(INPUT_GET, "name");
    $gallName = str_replace('_', ' ', $name);	
	$gallName = ucfirst($gallName);
    $titolo_form = "Edit gallery";
    $operation="mod";
}


?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$titolo_form?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header"><h3><?=$gallName?></h3></div>
        <div class="card-body">
            <div class="row">
<?php

if($operation=="add"){
?>
      <div class="col">
       <form class="form-horizontal row-fluid" action="core/mngGallery.php" method="POST" enctype="multipart/form-data">

            <div class="control-group">
                <label class="control-label" for="title">Gallery name</label>
                <div class="controls">
                    <input type="text" id="title" name="title" placeholder="Choose a name for your gallery" class="span8">
                     
                </div>
            </div>
         
            <div class="control-group" id="uploadFile">
                <input type="hidden" name="idToMod" value="<?=$idToMod?>" />

                <label class="control-label" for="file">Carica foto</label>
                <div class="controls">
                    <input type="file" id="file" name="file[]" multiple>
                </div>
                
            </div>
            
            
            <div class="control-group">
                <div class="controls">
                    
                    <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">
                    
                    
                </div>
            </div>
        </form>
        </div>
      <div class="col guide">
        descrizione
      </div>
            </div>
      <?php
}else if($operation=="mod"){
    ?>
    <script>
        function myFunction() {
            var x = document.getElementById("uploadFile");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }   
        }
        </script>
    <div id="changeFile" class="col-12 align-items-center pt-3 pb-2 mb-3 align-items-center clearfix">
            <a href="#" onclick="myFunction()" class="btn btn-success btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add an image to gallery</span>
            </a>
        </div>
        <?php
                $display="none";
        ?>
        <div class="col-12 mb-5" id="uploadFile" style="display:<?=$display?>;">
              <form class="form-horizontal row-fluid" action="core/mngGallery.php" method="POST" enctype="multipart/form-data">

            <div class="control-group">
                <input type="hidden" name="gall" value="<?=$name?>" />

                <label class="control-label" for="file"><?=$addfile_upload?></label>
                <div class="controls">
                    <input type="file" id="file" name="file">
                </div>
                
            </div>
            
            
            <div class="control-group">
                <div class="controls">
                    
                    <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">
                    
                    
                </div>
            </div>
        </form>
        </div>
    <?php
    foreach (glob("../uploads/gallery/$name/*") as $file) {
        
        $img=pathinfo($file, PATHINFO_FILENAME);
        $ext=pathinfo($file, PATHINFO_EXTENSION);
        $imgName=$img.".".$ext;
        ?>

<div class="col-3 border text-center p-3">
    <a href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#delete<?=$img?>">
        <!-- <a href="core/mngGallery.php?gallToDel=<?=$folder?>" class="btn btn-danger btn-icon-split"> -->
            <span class="icon text-white-50">
                <i class="fas fa-trash"></i>
            </span>
            <span class="text"><?=$txt_delete?></span>
        </a> <br><br>
        <img src="<?=$file?>" class="my-0 mx-auto" style="width:150px;"><br>
</div>
    <div class="modal fade" id="delete<?=$img?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b><?=$txt_modal_title?></b></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">If you want to delete this gallery click "Ok" below</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><?=$txt_cancel?></button>
                    <a class="btn btn-primary" href="core/mngGallery.php?imgToDel=<?=$imgName?>&gall=<?=$name?>">Ok</a>
                </div>
            </div>
        </div>
    </div>


<?php
    }
    ?>

    <div class="col-12 align-items-center pt-3 pb-2 mb-3 align-items-center clearfix">
            <a href="index.php?man=gall&op=show" class="btn btn-info btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back to galleries</span>
            </a>
        </div>
        </div>
    <?php
}
?>
</div>

    </div>

    </div>
</div>

