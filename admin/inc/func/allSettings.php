<?php

	$database = new Database();
	$db = $database->getConnection();

	$settings = new Settings ($db);
    
    $stmt = $settings->showSettings();


?>
<div class="module">
    <div class="module-body">

    <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Settings</h1>
        </div>
        <br>
        
        <?php

    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row);
       
            ?>

        <form class="form-horizontal row-fluid" action="core/mngSettings.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />

            <div class="control-group">
                <label class="control-label" for="site_name">Site Name</label>
                <div class="controls">

                    <input type="text" id="site_name" name="site_name" placeholder="Site name" class="span8" value="<?= $site_name ?>">
                        
                </div>
            </div>
            <div class="control-group">
                            <label class="control-label" for="site_description">Site description</label>
                <div class="controls">

                    <input type="text" id="site_description" name="site_description" placeholder="Site description" class="span8" value="<?= $site_description ?>">
                        
                </div>
            </div>
            <?php
            }

?>
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subReg" value="Submit">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
    </div>
</div>

<?php

// require "allMenu.php";
require "core/menu/index.php";

?>

    </div>
</div>

