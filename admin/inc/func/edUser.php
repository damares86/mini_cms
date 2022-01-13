<?php

require_once "../core/functions.php";
$conn = OpenConnection();

$type=filter_input(INPUT_GET,"type");
$idToMod=filter_input(INPUT_GET,"idToMod");

$usernameToMod="";
$passwordToMod="";
$userRole="";

if (filter_input(INPUT_GET, "idToMod")) {
    $titoloForm = "Edit User";

    $operation = "mod";
    $userIDToMod = $_GET["idToMod"];
    $userToModify = GetDataById($conn, "accounts", $userIDToMod);
    if ($userToModify) {
        $usernameToMod=$userToModify["username"];
        $passwordToMod=$userToModify["password"];
        $mailToMod=$userToModify["email"];
        $roleToMod=$userToModify["role_id"];
    }
}

?>

<div class="module">
    <div class="module-head">
        <h3>Edit User</h3>
    </div>
    <div class="module-body">

    <div class="col-md-8 m-auto">
    <form action="core/mngUser.php" method="POST" enctype="multipart/form-data">

<?php
if($type=="role"){
?>

   

    <form class="form-horizontal row-fluid" action="core/mngUser.php" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="operation" value="modUser" />
        <input type="hidden" name="idToMod" value="<?= $userIDToMod ?>" />

        <div class="control-group">
            <label class="control-label" for="username">Username</label>
            <div class="controls">
                <input type="text" id="username" name="username" placeholder="Choose the username" class="span8" value="<?=$usernameToMod?>">
                    
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
                <input type="text" id="email" name="email" placeholder="sample@mail.com" class="span8" value="<?=$mailToMod?>">
                    
            </div>
        </div>

        
        <div class="control-group">
            <label class="control-label">Role</label>
            <div class="controls">
            <?php

                $roles=GetAllRecords($conn,"roles");

                foreach($roles as $row){
                    $checked="";
                    if($roleToMod==$row["id"]){
                    $checked="checked";

                    }
                ?>      

                <label class="radio">
                    <input type="radio" name="rolename[]" value="<?=$row["id"]?>" checked="">
                    <?=$row["rolename"]?>
                </label> 

                <?php

                }

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
       
    </div>
<?php   

}else if($type=="pass"){
    ?>

    <h3>Change password for <b><?= $usernameToMod ?></b> </h3><br>
    
    <input type="hidden" name="operation" value="modPass" />
    <input type="hidden" name="idToMod" value="<?= $userIDToMod ?>" />
   

    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="inputPassword"><b>New password</b></label>
            <input type="text" class="form-control" id="password" name="password">
        </div>
        <br>
    </div>
    <br>
    

        <br>
        <input type="submit" class="btn btn-primary" name="subReg" value="Submit">

    </form>
</div>


         
        </div>
       
    </div>
<?php
    } else {
    header("Location:../index.php?err=noMod");
}



?> 
        
       
    </div>
</div>

