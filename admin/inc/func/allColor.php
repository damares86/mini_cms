<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$colors = new Colors($db);
    $settings = new Settings($db);
    

    $stmt = $settings->showSettings();
    

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Theme settings</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Choose your theme</h6>
        </div>
        <div class="card-body">
           

        <?php

    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row);
       
            ?>

        <form class="form-horizontal row-fluid" action="core/mngSettings.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />

           
            <div class="control-group">
                            <label class="control-label" for="site_description">Theme</label>
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
$stmt1 = $colors->showAll($from_record_num, $records_per_page);
$total_rows=$colors->countAll();


?>
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subTheme" value="Submit">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Box Background Colors</h6>
        </div>
        <div class="card-body">
            <a href="index.php?man=color&op=add" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add new color</span>
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
                                            <a href="core/mngColor.php?idToDel=<?=$row1["id"] ?>">
                                                <i class="fas fa-trash fa-2x text-gray-300"></i>
                                            </a>
                                        </div>
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
        echo "<div class='alert alert-danger'>No role found.</div>";
    }


?>

    </div>
</div>
</div>
</div>