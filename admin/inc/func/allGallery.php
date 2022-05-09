<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	
    
    $stmt = $file->showAll($from_record_num, $records_per_page);

    $total_rows=$file->countAll();

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Galleries</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All galleries</h6>
        </div>
        <div class="card-body">
        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <a href="index.php?man=gall&op=add" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add a new gallery</span>
            </a>
        </div>
        <br>
        <div class="row">
        <?php
            $dir_gall="../misc/gallery/img/";
            $dir_root="../misc/gallery/";
            function is_dir_empty($dir) {
                if (!is_readable($dir)) return null; 
                return (count(scandir($dir)) == 2);
              }
                if( is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){
                    echo "<div class='col'><div class='alert alert-danger'>No galleries found</div></div>";
                }else{
            foreach (glob("../misc/gallery/img/*") as $file) {
                $folder=pathinfo($file, PATHINFO_FILENAME);
                $gallery= str_replace("_"," ", $folder);
                $gallery=ucfirst($gallery);
                
                $images= scandir ($file);
                $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 
            

                ?>

                        <div class="col-xl-3 col-md-4 mb-4">
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
                                    <div class="row mt-3   ">
                                        <div class="col-6 text-right">
                                            <a href="index.php?man=gall&op=edit&name=<?=$folder?>" class="btn btn-warning btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <span class="text"><?=$txt_edit?></span>
                                            </a>   
                                           </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#delete<?=$folder?>">
                                            <!-- <a href="core/mngGallery.php?gallToDel=<?=$folder?>" class="btn btn-danger btn-icon-split"> -->
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text"><?=$txt_delete?></span>
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                                 <!-- Delete Modal-->
                    <div class="modal fade" id="delete<?=$folder?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <a class="btn btn-primary" href="core/mngGallery.php?gallToDel=<?=$folder?>">Ok</a>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php


                
            }
        }
                ?>
      
    </div>
</div>
</div>
</div>
</div>