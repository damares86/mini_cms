
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$addfile_title?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header"></div>
        <div class="card-body">
  <div class="row">
      <div class="col">
       <form class="form-horizontal row-fluid" action="core/mngFile.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="operation" value="add" />

            <div class="control-group">
                <label class="control-label" for="title"><?=$addfile_filetitle?></label>
                <div class="controls">
                    <input type="text" id="title" name="title" placeholder="<?=$addfile_filetitle_ph?>" class="span8">
                     
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="file"><?=$addfile_upload?></label>
                <div class="controls">
                    <input type="file" id="myfile" name="myfile">
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
        <?=$addfile_desc?>
      </div>
  </div>
    </div>
        </div>

    </div>
</div>
