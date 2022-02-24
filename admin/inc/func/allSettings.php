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

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Page Name</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Child of</th>
                    <th scope="col">Item order</th>
                    <th scope="col">Up</th>
                    <th scope="col">Down</th>
                    <th scope="col">In menu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $menu->showAllParent();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $order=$itemorder;
                    $parentID=$id;
                    $checkedMenu ="";
                    $checkedParent = "checked";
                    $page=$pagename;
                    $childSpace="&nbsp;---&nbsp;";
               
                    
                    ?>
                <tr style="background-color:#bdeeff">
                    <td><b><?=$pagename?></b><input type="hidden" name="idParent[]" value="<?= $parentID ?>" /></td>
                    <td>Yes</td>
                    <td>
                        <input type="checkbox" name="childofParent<?= $id ?>" value="1">
                    </td>
                    <td>
                        <input type="hidden" name="itemorderParent<?= $id ?>" value="<?= $order ?>" /> 
                        <?=$order?>
                    </td>
                    <td> 
                        <input type="radio" id="upParent" name="orderParent<?= $id ?>" value="upParent"> <i class="menu-icon icon-arrow-up"></i> Up
                    </td>
                    <td>
                        <input type="radio" id="downParent" name="orderParent<?= $id ?>" value="downParent"> <i class="menu-icon icon-arrow-down"></i> Down
                    </td>
                        
                       
                        
    
                    </td>
                    <td><input type="checkbox" name="inmenuParent<?=$parentID?>"> Remove</td>
                </tr>
                <?php
                    $menu->childof=$page;
                    $stmt3=$menu->showAllChildInMenu();
                    while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
                        extract($row3);
                        $childID=$id;
                        $child=$childof;
                        $order1=$itemorder;
                       
                        $checkedParent="";
                        ?>

                        <tr style="background-color: #e7fcff">
                        <td><?=$childSpace?><?=$pagename?><input type="hidden" name="idChild[]" value="<?= $childID ?>" /></td>
                        <td>
                            <input type="checkbox" name="parentChild<?= $childID ?>" value="1">
                    
                        </td>
                        <td>
                                <select name="childofChild<?= $childID ?>">
                                    <?php
                                    $stmt4 = $menu->showAllParent();
                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
                                        extract($row4);
                                        $selected = "";
                                        if ($child==$pagename) {
                                            $selected = "selected";
                                        }
                                        echo "<option value='{$pagename}' $selected>{$pagename}</option>";
                                    }
                                    ?>
                                </select>  
                            </td>
                        <td>
                            <input type="hidden" name="itemorderChild<?= $childID ?>" value="<?= $order1 ?>" />
                            <?=$order1?>
                        </td>
                        <td>
                            <input type="radio" id="upChild" name="orderChild<?= $childID ?>" value="upChild"> <i class="menu-icon icon-arrow-up"></i> Up
                        </td>
                        <td>
                        <input type="radio" id="downChild" name="orderChild<?= $childID?>" value="downChild"> <i class="menu-icon icon-arrow-down"></i> Down
                        </td>
                          
        
                    <td><input type="checkbox" name="inmenuChild<?=$childID?>"> Remove</td>
                     
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
                    <th scope="col">In menu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $menu->showAllNotInMenu();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $noMenuID=$id;
                 
                ?>
                <tr>
                    <td><?=$pagename?><input type="hidden" name="idNoMenu[]" value="<?= $noMenuID ?>" /></td>
                    <td><input type="checkbox" name="notInMenu<?= $noMenuID ?>"> Add</td>
                
                </tr>
            <?php   
            }
        ?>
                            </tbody>
        </table>
        <hr>
        <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subMenu" value="Submit">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
    </div>
</div>

