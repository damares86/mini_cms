<?php

require_once "../core/functions.php";
$conn = OpenConnection();

$type=filter_input(INPUT_GET,"type");

$usernameToMod="";
$passwordToMod="";

$userAdmin=GetDataByUsername($conn,"admin",$user);
$usernameToMod=$userAdmin['username'];
$passwordToMod=$userAdmin["password"];


?>

<div class="module">
    <div class="module-head">
        <h3>Edit Admin</h3>
    </div>
    <div class="module-body">

    <div class="col-md-8 m-auto">
    <form action="core/mngAdmin.php" method="POST" enctype="multipart/form-data">

<?php
if($type=="name"){
?>

   

    <!-- <form class="form-horizontal row-fluid" action="core/mngAdmin.php" method="POST" enctype="multipart/form-data"> -->
        
        <input type="hidden" name="operation" value="modUser" />

        <div class="control-group">
            <label class="control-label" for="username">Username</label>
            <div class="controls">
                <input type="text" id="username" name="username" placeholder="Choose the username" class="span8" value="<?=$usernameToMod?>">
                    
            </div>
        </div>

      
        
        <div class="control-group">
            <div class="controls">
                
                <input type="submit" class="btn btn-primary" name="subName" value="Submit">

                <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
            </div>
        </div>
    </form>

</div>


         
        </div>
       
    </div>
<?php

}else if($type=="psw"){
    ?>

    <h3>Change password for <b><?= $user ?></b> </h3><br>
    
    <input type="hidden" name="operation" value="modPass" />

    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="inputPassword"><b>New password</b></label>
            <input type="text" class="form-control" id="password" name="password">
        </div>
        <br>
    </div>
    <br>
    

        <br>
        <input type="submit" class="btn btn-primary" name="subPass" value="Submit">

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

