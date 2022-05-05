<?php
// MODIFICARE SU LOCALE !!!!!!!!!!!!!!!!!!!!


?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Upload photo</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header"></div>
        <div class="card-body">
  <div class="row">
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
    </div>
        </div>

    </div>
</div>
