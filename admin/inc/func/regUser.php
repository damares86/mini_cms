<?php

$operation = "add";
$titoloForm = "Add User";

$postToMod="";
$idToMod="";

if(filter_input(INPUT_GET,"idToMod")){
    $idToMod = filter_input(INPUT_GET,"idToMod");
    $titoloForm="Edit User";
    $operation="mod";
}


?>


<div class="module">
    <div class="module-head">
        <h3><?=$titoloForm?></h3>
    </div>
    <div class="module-body">

        <form class="form-horizontal row-fluid" action="core/mngUser.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="operation" value="<?=$operation?>" />
        <input type="hidden" name="type" value="user" />

        <?php 
      
        $user = new User($db);
        $user->id = $idToMod;
        

      
           if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                <?php 
                } 
        $user->showById();

        ?>
            <div class="control-group">
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                    <input type="text" id="username" name="username" placeholder="Choose the username" value="<?=$user->username?>" class="span8">
                     
                </div>
            </div>
            <?php
            if($operation=="add"){
            ?>
            <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="text" id="password" name="password" placeholder="Choose the password" class="span8">
                     
                </div>
            </div>
            <?php
            }
            ?>

            <div class="control-group">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                    <input type="text" id="email" name="email" placeholder="sample@mail.com" value="<?=$user->email?>" class="span8">
                     
                </div>
            </div>

           
            <div class="control-group">
                <label class="control-label">Role</label>
                <div class="controls">
                <?php

                    $stmt = $role->showAll();

                    while($row_roles = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row_roles);
                        
                        $roleToMod = $user->rolename;
                        $rolename = $row_roles['rolename'];
                        $checked="";
                        if($roleToMod==$row_roles['rolename']){
                        $checked='checked="checked"';
    
                        }
                    

                    ?>
                        <label class="radio">
                        <input type="radio" name="rolename[]" value="<?=$row_roles["rolename"]?>" <?=$checked?>>
                        <?=$row_roles["rolename"]?>
                    </label> 

                    <?php
                    }

                    ?>      

                    

                   <?php

                    // }

                    ?>
                   
                </div>
            </div>

          
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

if($operation=="mod"){
    ?>
<div class="module">
    <div class="module-head">
        <h3>New User's Password</h3>
    </div>
    <div class="module-body">
        <form class="form-horizontal row-fluid" action="core/mngPass.php" method="POST" enctype="multipart/form-data">
            <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />

                    <input type="text" id="password" name="password" placeholder="Choose the new password" class="span8">
                        
                </div>
            </div>
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
}

?>