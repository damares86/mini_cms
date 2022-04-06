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
                        <h1 class="h3 mb-0 text-gray-800">Site settings</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Site details</h6>
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

                <label class="control-label" for="site_name">Site Name</label>
             

                    <input type="text" id="site_name" name="site_name" placeholder="Site name" class="span12" value="<?= $site_name ?>">
              
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
    <div class="col rounded guide mx-3">
        Choose the Site name and the description, that will be shown on the top of the pages and in the browser header. <br><br>
        
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
            <h6 class="m-0 font-weight-bold text-primary">Contact information</h6>
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

                <label class="control-label" for="inbox">Email Address for Contact</label>
                <div class="controls">
             

                    <input type="text" id="inbox" name="inbox" placeholder="es. info@yoursite.com" class="span12" value="<?= $row1['inbox']  ?>">
                    </div>
            </div>
   <br>
            <div class="control-group">
                            <label class="control-label" for="reset">Email Address for Password Reset</label>
                <div class="controls">

                    <input type="text" id="reset" name="reset" placeholder="es. noreply@yoursite.com" class="span8" value="<?= $row1['reset'] ?>">
                        
                </div>
            </div>
   
            <br>
            <?php
            }   
?>
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subMail" value="Submit">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
        </div>
    <div class="col rounded guide mx-3">
        Specify your email, in order to make the contact form and the password reset working correctly. <br><br>
        <ul>
            <li><b>Email Address for Contact:</b> this is the email which will receive the messages sent from the contact form</li>
            <li><b>Email Address for Password Reset:</b> this is the email used in the password reset procedure, it's good to use a different mail, like noreply@yoursite.com (anyway it will work properly also if you use the same email)</li>
        </ul>
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
            <h6 class="m-0 font-weight-bold text-primary">Google reCAPTCHA v3</h6>
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
                <label class="control-label">Use reCAPTCHA v3</label>
                    <div class="controls">
                        <input type="checkbox" name="verify" value="1" <?=$checked?>> 
                    </div>
            </div>
<br>
            <div class="control-group">

                <label class="control-label" for="public">Public Key</label>
                <div class="controls">
             

                    <input type="text" id="public" name="public" placeholder="" class="span12" value="<?= $row2['public']  ?>">
                    </div>
            </div>
   <br>
            <div class="control-group">
                            <label class="control-label" for="secret">Secret Key</label>
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
                   
                    <input type="submit" class="btn btn-primary" name="subKey" value="Submit">

                    <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                </div>
            </div>
        </form>
        </div>
    <div class="col rounded guide mx-3">
        This is a tool to avoid spam attack on your email address. <br><br>
        You need to create two keys going to <a href="https://www.google.com/recaptcha/admin" target="_blank">this page</a>, then you can select the "Use Recaptcha" checkbox and paste the two keys given by Google.<br><br>
        Discover more about <a href="https://developers.google.com/search/blog/2018/10/introducing-recaptcha-v3-new-way-to" target="_blank">Google reCAPTCHA v3</a>
    </div>
</div>
    </div>
</div>
</div>


<?php
}else if($man=="menu"){
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Menu settings</h1>

                    </div><div class="row">
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">

        <div class="row guide">
            <div class="col">
                Here you can decide which pages will be shown in the menu of your website and also create a hierarchy of the pages.<br>
                There are three tables:<br><br>
                <ul>
                    <li><b>Pages in menu:</b> these are the pages shown in menu; you can see if they are "parent" or "child" (the "children" are tabbed to right and have a different background), you can change the view order using "Up" and "Down" and you can remove the page from menu.</li>
                </ul>
                </div>
                <div class="col">
                    <ul>
                        <li><b>Children without parent:</b> these are pages marked as "children" but they don't have any parent (you can choose it using the dropdown menu)</li>
                        <li><b>Page not in menu:</b> these are the page which are not shown in menu, you can insert them selecting "Add"</li>
                    </ul>
                    <br>
                    <b>NOTE:</b> to save the changes you have to click on the <b>Refresh</b> button.



            </div>
        </div>
    <form class="form-horizontal row-fluid" action="core/mngSettings.php" method="POST" enctype="multipart/form-data">
       
        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
       
        <h3><b>Pages in menu</b></h3>
<br>
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
        <div class="row">
            <div class="col-md-6">
            <h3><b>Children without parent</b></h3>
            <br>
            <table class="table table-striped">

            <thead>
                <tr>
                    <th scope="col">Page Name</th>
                    <th scope="col">Parent</th>
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
            <h3><b>Page not in menu</b></h3>
            <br>
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
            </div>
        </div>
       
        
     
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
</div></div>
<?php
}
?>