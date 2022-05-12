<?php

	$database = new Database();
	$db = $database->getConnection();

    $menu = new Menu($db);
    $settings = new Settings ($db);
    $contact = new Contact ($db);
    $verify = new Verify ($db);
    $stmt = $settings->showSettings();
    $man=filter_input(INPUT_GET,"man");
if($man=="settings"){
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$site_title?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$site_box1_title?></h6>
        </div>
        <div class="card-body">
           
           
        <div class="row">
    <div class="col">
        
        <?php

    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row);
                $checked="";
            ?>

        <form class="form-horizontal row-fluid" action="core/mngSettings.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" />
            
            <?php
            if($row['use_text']==1){
                $checked="checked";
            }
            ?>
            <input type="checkbox" name="use_text" value="1" <?=$checked?>> Show name and description in the website<br><br>


            <div class="control-group">
                <label class="control-label" for="site_name"><?=$site_sitename?></label>
                <div class="controls">
                    <input type="text" id="site_name" name="site_name" placeholder="<?=$site_sitename?>" class="span12" value="<?= $site_name ?>">
                </div>
            </div>
            <div class="control-group">
                 <label class="control-label" for="site_description"><?=$site_sitedescription ?></label>
                <div class="controls">

                    <input type="text" id="site_description" name="site_description" placeholder="<?=$site_sitedescription ?>" class="span8" value="<?= $site_description ?>">
                        
                </div>
            </div>

            <br>

            <div class="control-group">
                            <label class="control-label" for="footer"><?=$site_footer ?></label>
                <div class="controls">

                    <input type="text" id="footer" name="footer" placeholder="<?=$site_footer ?>" class="span8" value="<?= $footer ?>">
                        
                </div>
            </div>

            <br>

            <div class="control-group">
                            <label class="control-label" for="language"><?=$site_lang?></label>
                <div class="controls">

                <select name="language">
                <?php
                $lang =glob("locale/*.php", GLOB_BRACE);

            foreach ($lang as $file) {
                    $language=pathinfo($file, PATHINFO_FILENAME);
                    $selected = "";
                    if ($language == $dashboard_language) {
                        $selected = "selected";
                    }
                    echo "<option value='{$language}' $selected >{$language}</option>";

                
            }
                ?>
            </select>
                        
                </div>
            </div>
   
            
            <?php
            } 
?>
<br>
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
        </div>
    <div class="col rounded guide mx-3">
        <?=$site_box1_desc ?>
        
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
            <h6 class="m-0 font-weight-bold text-primary"><?=$site_box2_title?></h6>
        </div>
        <div class="card-body">
           
        <div class="row">
    <div class="col">
        
        <?php

            $stmt1=$contact->showAll();
    
            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row1);
       
            ?>

        <form class="form-horizontal row-fluid" action="core/mngSettings.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row1['id']?>" />
            <div class="control-group">

                <label class="control-label" for="inbox"><?=$site_inbox?></label>
                <div class="controls">
             

                    <input type="text" id="inbox" name="inbox" placeholder="<?=$site_inbox_ph?>" class="span12" value="<?= $row1['inbox']  ?>">
                    </div>
            </div>
   <br>
            <div class="control-group">
                            <label class="control-label" for="reset"><?=$site_reset?></label>
                <div class="controls">

                    <input type="text" id="reset" name="reset" placeholder="<?=$site_reset_ph?>" class="span8" value="<?= $row1['reset'] ?>">
                        
                </div>
            </div>
   
            <br>
            <?php
            }   
?>
<br>
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subMail" value="<?=$txt_submit?>">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
        </div>
    <div class="col rounded guide mx-3">
        <?=$site_box2_desc?>
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
            <h6 class="m-0 font-weight-bold text-primary"><?=$site_box3_title?></h6>
        </div>
        <div class="card-body">
           
<div class="row">
    <div class="col">
        
        <?php

            $stmt2=$verify->showAll();
    
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row2);
                $checked="";
                if($row2['active']==1){
                    $checked="checked";
                }
            ?>

        <form class="form-horizontal row-fluid" action="core/mngSettings.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row2['id']?>" />
            <div class="control-group">
                <label class="control-label"><?=$site_useRec?></label>
                    <div class="controls">
                        <input type="checkbox" name="verify" value="1" <?=$checked?>> 
                    </div>
            </div>
<br>
            <div class="control-group">

                <label class="control-label" for="public"><?=$site_public?></label>
                <div class="controls">
             

                    <input type="text" id="public" name="public" placeholder="" class="span12" value="<?= $row2['public']  ?>">
                    </div>
            </div>
   <br>
            <div class="control-group">
                            <label class="control-label" for="secret"><?=$site_secret?></label>
                <div class="controls">

                    <input type="text" id="secret" name="secret" placeholder="" class="span8" value="<?= $row2['secret'] ?>">
                        
                </div>
            </div>
   
            <br>
            <?php
            } 
?>
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subKey" value="<?=$txt_submit?>">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
        </div>
    <div class="col rounded guide mx-3">
      <?=$site_box3_desc?>
    </div>
</div>
    </div>
</div>
</div>


<?php
}else if($man=="menu"){
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$menu_title?></h1>

                    </div><div class="row">
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
        <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#infoMenu">
                        <span class="icon text-white-50">
                            <i class="fas fa-fw fa-question"></i>
                        </span>
                        <span class="text"><?=$menu_info?></span>
                    </a> <br>
             <!-- Info Modal-->
             <div class="modal fade" id="infoMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b><?=$menu_info?></b></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body guide">
                                    <?=$menu_desc?>
 
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" data-dismiss="modal"><?=$txt_close?></button>
                                </div>
                            </div>
                        </div>
                    </div>
            <br>
           
            <br>
      
    <form class="form-horizontal row-fluid" action="core/mngSettings.php" method="POST" enctype="multipart/form-data">
       
        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
       
        <h3><b><?=$menu_t1_title?></b></h3>
<br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?=$menu_name?></th>
                    <th scope="col"><?=$menu_parent?></th>
                    <th scope="col"><?=$menu_t1_child?></th>
                    <th scope="col"><?=$menu_t1_order?></th>
                    <th scope="col"><?=$menu_t1_up?></th>
                    <th scope="col"><?=$menu_t1_down?></th>
                    <th scope="col"><?=$menu_inmenu?></th>
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
                    <td><?=$menu_t1_yes?></td>
                    <td>
                        <input type="checkbox" name="childofParent<?= $id ?>" value="1">
                    </td>
                    <td>
                        <input type="hidden" name="itemorderParent<?= $id ?>" value="<?= $order ?>" /> 
                        <?=$order?>
                    </td>
                    <td> 
                        <input type="radio" id="upParent" name="orderParent<?= $id ?>" value="upParent"> <i class="menu-icon icon-arrow-up"></i> <?=$menu_t1_up?>
                    </td>
                    <td>
                        <input type="radio" id="downParent" name="orderParent<?= $id ?>" value="downParent"> <i class="menu-icon icon-arrow-down"></i> <?=$menu_t1_down?>
                    </td>
                        
                       
                        
    
                    </td>
                    <td><input type="checkbox" name="inmenuParent<?=$parentID?>"><?=$menu_t1_remove?></td>
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
                          
        
                    <td><input type="checkbox" name="inmenuChild<?=$childID?>"> <?=$menu_t1_remove?></td>
                     
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <br><br>
        <div class="row">
            <div class="col-md-6">
            <h3><b><?=$menu_t2_title?></b></h3>
            <br>
            <table class="table table-striped">

            <thead>
                <tr>
                    <th scope="col"><?=$menu_name?></th>
                    <th scope="col"><?=$menu_parent?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt2 = $menu->showAllChildNone();
                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                    extract($row2);
                    $childNoneID=$id;
                 
                ?>
                <tr>
                    <td><?=$pagename?><input type="hidden" name="idChildNone[]" value="<?= $childNoneID ?>" /></td>
                    <td>
                                <select name="childNone<?= $childNoneID ?>">
                                    <option value="<?= $childNoneID ?>" selected>none</option>
                                    <?php
                                    $stmt5 = $menu->showAllParent();
                                    while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)){
                                        extract($row5);
                                        
                                        echo "<option value='{$pagename}'>{$pagename}</option>";
                                    }
                                    ?>
                                </select>  
                            </td>
                
                </tr>
            <?php   
            }
        ?>
                            </tbody>
        </table>
            </div>
            <div class="col-md-6 border-left">
            <h3><b><?=$menu_t3_title?></b></h3>
            <br>
        <table class="table table-striped">

            <thead>
                <tr>
                    <th scope="col"><?=$menu_name?></th>
                    <th scope="col"><?=$menu_inmenu?></th>
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
                    <td><input type="checkbox" name="notInMenu<?= $noMenuID ?>"> <?=$menu_t2_add ?></td>
                
                </tr>
            <?php   
            }
        ?>
                            </tbody>
        </table>
            </div>
        </div>
       
        
     
        <hr>
        <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subMenu" value="<?=$menu_refresh?>">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
    </div>
</div>
</div></div>
<?php
}
?>