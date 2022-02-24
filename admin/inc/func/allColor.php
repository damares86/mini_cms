<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$colors = new Colors($db);
    $settings = new Settings($db);
    

    $stmt = $settings->showSettings();
    

?>
<div class="module">
    <div class="module-body">

    <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Choose theme</h1>
        </div>
        <br>
        
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
$stmt = $colors->showAll($from_record_num, $records_per_page);
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
<div class="module">
    <div class="module-body">

        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Box Background Colors</h1>
            <a href="index.php?man=color&op=add"><button type="button" class="btn btn-success">Add new color +</button></a>
        </div>
        <br>
        <?php

if($total_rows>0){
    ?>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Color</th>
                    <th scope="col">HEX code</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row);
       
            ?>
            <tr>
                <td><?=$id?></td>
                <td style="background-color: <?=$color?>;" >
                    
                </td>
                <td><?=$color?></td>

      
                       
                        <td><a href="core/mngColor.php?idToDel=<?=$row["id"] ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
                    </tr>
                <?php
                }
                ?>


            </tbody>
        </table>
        <?php
        // paging buttons
        include_once 'inc/paging.php';
    }
      
    // tell the user there are no products
    else{
        echo "<div class='alert alert-danger'>No role found.</div>";
    }


?>

    </div>
</div>
