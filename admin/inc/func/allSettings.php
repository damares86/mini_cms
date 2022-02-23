<?php

	$database = new Database();
	$db = $database->getConnection();

	$settings = new Settings ($db);
    $menu = new Menu($db);
    
    $stmt = $settings->showSettings();


?>
<div class="module">
    <div class="module-body">

    <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Site settings</h1>
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
            <!-- <div class="control-group">
                            <label class="control-label" for="site_description">Theme</label>
                <div class="controls">
                <select name="theme">
                <?php
            // foreach (glob("../assets/*") as $file) {
            //     if( is_dir($file) ){
            //         $folder=pathinfo($file, PATHINFO_FILENAME);
            //         $selected = "";
            //         if ($folder == $row['theme']) {
            //             $selected = "selected";
            //         }
            //         echo "<option value='{$folder}' $selected >{$folder}</option>";

            //     }
            // }
                ?>
            </select>
                        
                </div>
            </div> -->
            
            <?php
            } 
// } 

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
// require "core/menu/index.php";


?>

<div class="module">
    <div class="module-body">

        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Menu settings</h1>
            
        </div><br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">In menu</th>
                    <th scope="col">Page Name</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Child of</th>
                    <th scope="col">Item order</th>
                </tr>
            </thead>
            <tbody>
        <?php


        $stmt = $menu->showAllParent();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
            extract($row);
                $order=$itemorder;
                $order1=$itemorder;
                $checkedMenu ="";
                $checkedParent = "checked";
                $page=$pagename;
                
                $childSpace="&nbsp;---&nbsp;";

                if($inmenu==1){
                    $checkedMenu="checked";
                }
                // if($parent==1){
                //     $checkedParent="checked";
                //     $child="";
                // }           
                 // if($user->showPermissionActive($idToMod,$id_product)){
                //     $checked = "checked";
                // }
       
           
        ?>
        <tr>
                <td><input type="checkbox" name="inmenu[]" value="<?= $id ?>" <?=$checkedMenu?>></td>
                    <td><?=$pagename?></td>
                    <td><input type="checkbox" name="parent[]" value="<?= $id ?>" <?=$checkedParent?>></td>
                    <td>
                        -
                    </td>
                    <td>
                    <select name="itemorder">
                        <?php
                       
                        $stmt2 = $menu->countAll();

                        
                        for ($i=1; $i <= $stmt2 ; $i++) { 
                          
                            $selected="";
                            if($i == $order){
                                $selected = "selected";
                            }
                            echo "<option value='{$i}' $selected>{$i}</option>";

                            $selected="";
                        }
                   

                        ?>
                    </select>    
                    </td>
           
      
            </tr>
            <?php
            $menu->childof=$page;
            $stmt3=$menu->showAllChild();
                while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
                    extract($row3);
                    $child=$childof;
                    $order1=$itemorder;
                    $checkedParent="";
                    ?>
                    <tr>
                        <td><input type="checkbox" name="inmenu[]" value="<?= $id ?>" <?=$checkedMenu?>></td>
                    <td><?=$childSpace?><?=$pagename?></td>
                    <td><input type="checkbox" name="parent[]" value="<?= $id ?>" <?=$checkedParent?>></td>
                    <td>

                    <select name="childof">
                        <?php
                    
                        $stmt4 = $menu->showAllParent();

                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
                
                            extract($row4);
                        
                            $selected = "";
                            if ($child==$pagename) {
                                $selected = "selected";
                            }
                            echo "<option value='{$id}' $selected>{$pagename}</option>";

                        }

                        ?>
                    </select>  
                   
                    </td>
                    <td>
                    <select name="itemorder1">
                        <?php
                       
                        $stmt2 = $menu->countAll();

                        
                        for ($i=1; $i <= $stmt2 ; $i++) { 
                          
                            $selected="";
                            if($i == $order1){
                                $selected = "selected";
                            }
                            echo "<option value='{$i}' $selected>sub-> {$i}</option>";

                            $selected="";
                        }
                   

                        ?>
                    </select>    
                    </td>
                    </tr>
            <?php

                }
        
            
            ?>
      <?php
            }
      ?>
        
     </tbody>
</table>
<br><br>
<h4>Page not in menu</h4>
<table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">In menu</th>
                    <th scope="col">Page Name</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Child of</th>
                    <th scope="col">Item order</th>
                </tr>
            </thead>
            <tbody>
<?php


$stmt = $menu->showAllNotInMenu();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
    extract($row);
        $order=$itemorder;
        $order1=$itemorder;
        $checkedMenu ="";
        $checkedParent = "checked";
        $page=$pagename;
        
        $childSpace="&nbsp;---&nbsp;";

        if($inmenu==1){
            $checkedMenu="checked";
        }
        // if($parent==1){
        //     $checkedParent="checked";
        //     $child="";
        // }           
         // if($user->showPermissionActive($idToMod,$id_product)){
        //     $checked = "checked";
        // }

   
?>
<tr>
        <td><input type="checkbox" name="inmenu[]" value="<?= $id ?>" <?=$checkedMenu?>></td>
            <td><?=$pagename?></td>
            <td><input type="checkbox" name="parent[]" value="<?= $id ?>" <?=$checkedParent?>></td>
            <td>
                -
            </td>
            <td>
            <select name="itemorder">
                <?php
               
                $stmt2 = $menu->countAll();

                
                for ($i=1; $i <= $stmt2 ; $i++) { 
                  
                    $selected="";
                    if($i == $order){
                        $selected = "selected";
                    }
                    echo "<option value='{$i}' $selected>{$i}</option>";

                    $selected="";
                }
           

                ?>
            </select>    
            </td>
   

    </tr>
    <?php
    $menu->childof=$page;
    $stmt3=$menu->showAllChild();
        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
            extract($row3);
            $child=$childof;
            $order1=$itemorder;
            $checkedParent="";
            ?>
            <tr>
                <td><input type="checkbox" name="inmenu[]" value="<?= $id ?>" <?=$checkedMenu?>></td>
            <td><?=$childSpace?><?=$pagename?></td>
            <td><input type="checkbox" name="parent[]" value="<?= $id ?>" <?=$checkedParent?>></td>
            <td>

            <select name="childof">
                <?php
            
                $stmt4 = $menu->showAllParent();

                while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
        
                    extract($row4);
                
                    $selected = "";
                    if ($child==$pagename) {
                        $selected = "selected";
                    }
                    echo "<option value='{$id}' $selected>{$pagename}</option>";

                }

                ?>
            </select>  
           
            </td>
            <td>
            <select name="itemorder1">
                <?php
               
                $stmt2 = $menu->countAll();

                
                for ($i=1; $i <= $stmt2 ; $i++) { 
                  
                    $selected="";
                    if($i == $order1){
                        $selected = "selected";
                    }
                    echo "<option value='{$i}' $selected>sub-> {$i}</option>";

                    $selected="";
                }
           

                ?>
            </select>    
            </td>
            </tr>
    <?php

        }

    
    ?>
<?php
    }
?>
</tbody>
</table>


    </div>
</div>

