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
// require "core/menu/index.php";


?>

<div class="module">
    <div class="module-body">
    <form class="form-horizontal row-fluid" action="core/mngSettings.php" method="POST" enctype="multipart/form-data">
       
        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Menu settings</h1>
            
        </div><br>
        <h3><u>Page in menu</u></h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Page Name</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Child of</th>
                    <th scope="col">Item order</th>
                    <th scope="col">In menu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $menu->showAllParent();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $order1=$itemorder;
                    $order=$itemorder;
                    $checkedMenu ="";
                    $checkedParent = "checked";
                    $page=$pagename;
                    $childSpace="&nbsp;---&nbsp;";
                    if($inmenu==1){
                        $checkedMenu="checked";
                    }

                ?>
                <tr>
                    <td><?=$pagename?><input type="hidden" name="idParent[]" value="<?= $id ?>" /></td>
                    <td><input type="checkbox" name="parent" value="1" <?=$checkedParent?>></td>
                    <td>
                    <input type="hidden" name="childof" value="none">
                        -
                    </td>
                    <td>
                        <select name="itemorderParent">
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
                    <td><input type="checkbox" name="inmenuParent"> Remove</td>
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
                            
                            <td><?=$childSpace?><?=$pagename?><input type="hidden" name="idChild[]" value="<?= $id ?>" /></td>
                            <td><input type="checkbox" name="parent" value="1" <?=$checkedParent?>></td>
                            <td>
                                <select name="childofChild">
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
                            <select name="itemorderChild">
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
                        <td><input type="checkbox" name="inmenuChild"> Remove</td>
                    </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <br><br>
        <h3><u>Page not in menu</u></h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Page Name</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Child of</th>
                    <th scope="col">Item order</th>
                    <th scope="col">In menu</th>
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
                ?>
                <tr>
                    <td><?=$pagename?><input type="hidden" name="idNoMenu[]" value="<?= $id ?>" /></td>
                    <td><input type="checkbox" name="parent" value="1" <?=$checkedParent?>></td>
                    <td>
                        -
                    </td>
                    <td>
                        <select name="itemorderNotInMenu">
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
                    <td><input type="checkbox" name="notInMenu"> Add</td>
                </tr>
            <?php   
            }
        ?>
            </tbody>
        </table>
        <hr>
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subMenu" value="Refresh">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
    </form>
    </div>
</div>

