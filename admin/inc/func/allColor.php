<?php
    require "core/config.php";

    $stmt = $settings->showSettings();
    

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$theme_title?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$theme_box1_title?></h6>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col">
        <?php

    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row);
       
            ?>

        <form class="form-horizontal row-fluid" action="core/mngSettings.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />

           
            <div class="control-group">
                            <label class="control-label" for="site_description"><?=$theme_theme?></label>
                <div class="controls">
                <select name="theme">
                <?php
            foreach (glob("../assets/*") as $file) {
                if( is_dir($file) ){
                    $folder=pathinfo($file, PATHINFO_FILENAME);
                    $selected = "";
                    if ($folder == $row['theme']) {
                        $selected = "selected";
                    }
                    echo "<option value='{$folder}' $selected >{$folder}</option>";

                }
            }
                ?>
            </select>
                        
                </div>
            </div>
            
            <?php
            } 
// } 
$stmt1 = $colors->showAllList();
$total_rows=$colors->countAll();


?>
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subTheme" value="<?=$txt_submit?>">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
        </div>
            <div class="col guide">
                <?=$theme_box1_desc?>
            </div>
        </div>

    </div>
</div>
</div>

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$theme_box2_title?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
            <a href="index.php?man=color&op=add" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?=$theme_box2_add?></span>
            </a>
            <br>
            <br>

   
        <?php

if($total_rows>0){
    ?>

<div class="row">
        <?php
            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row1);
                 $colorValue="#000";
                 if($color=="#000000"){
                     $colorValue="#ffffff";
                 }
       
            ?>

         <div class="col-xl-3 col-md-4 mb-4">
                            <div class="card shadow h-100 py-2" style="background-color: <?=$color?>;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold" style="color:<?=$colorValue?>;"><?=$color?></div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" data-toggle="modal" data-target="#delete<?=$row1['id']?>">

                                            <!-- <a href="core/mngColor.php?idToDel=<?=$row1["id"] ?>"> -->
                                                <i class="fas fa-trash fa-2x text-gray-300"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        <!-- Delete Modal-->
        <div class="modal fade" id="delete<?=$row1['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b><?=$txt_modal_title?></b></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body"><?=$theme_modal_text?></div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><?=$txt_cancel?></button>
                                    <a class="btn btn-primary" href="core/mngColor.php?idToDel=<?=$row1["id"] ?>">Ok</a>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
        // // paging buttons
        // include_once 'inc/paging.php';
    }
    ?>
</div>
<?php
    // tell the user there are no products
}else{
        echo "<div class='alert alert-danger'>$theme_nocolor</div>";
    }


?>
</div>
                <div class="col-4 guide m-0">
                    <?=$theme_box2_desc?>
                </div>
            </div>
    </div>
</div>
</div>
</div>