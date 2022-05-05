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
        <?php
            $dir_gall="../uploads/gallery/";
            function is_dir_empty($dir) {
                if (!is_readable($dir)) return null; 
                return (count(scandir($dir)) == 2);
              }
                if( is_dir_empty($dir_gall) ){
                    echo "<div class='alert alert-danger'>No galleries found</div>";
                }else{
            foreach (glob("../uploads/gallery/*") as $file) {
                $folder=pathinfo($file, PATHINFO_FILENAME);
                $images= scandir ($file);
                $firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." 
            

                ?>

                <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-12">
                                            <div class="text-s font-weight-bold text-success text-uppercase mb-1">
                                                <?=$folder?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                    </div>
                                    <div class="row my-5">
                                        <div class="col-12">
                                            <img src="<?=$firstFile?>" style="max-width:100%;">
                                        </div>                                
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="#" class="btn btn-warning btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <span class="text"><?=$txt_edit?></span>
                                            </a>   
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete<?=$row['id']?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text"><?=$txt_delete?></span>
                                            </a> 
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