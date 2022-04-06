<?php

$operation = "add";
$titoloForm = "Add User";

$postToMod="";
$idToMod="";

if(filter_input(INPUT_GET,"idToMod")){
    $idToMod = filter_input(INPUT_GET,"idToMod");
    $titoloForm="User Management";
    $operation="mod";
}


?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$titoloForm?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> User data</h6>
       

        </div>
        <div class="card-body">
        <div class="row">
      <div class="col">
        <form class="form-horizontal row-fluid" action="core/mngUser.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="operation" value="<?=$operation?>" />

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
            <?php
            
           
            
            if($idToMod!=1){
            ?>
            <div class="control-group">
                <label class="control-label">Role</label>
                <div class="controls">
                <?php

                    $stmt = $role->showAllList();

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

                    

                   
                   
                </div>
            </div>
            <?php

}

?>
          <br>
          <br>
            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn " name="subReg" value="Submit">

                </div>
            </div>
        </form>
        </div>
      <div class="col guide">
          There are two different roles for a new user:<br>
          <ul>
              <li><b>Editor:</b> It can create, modify and delete pages, posts and categories. It can also manage website's settings, like site name or theme.</li>
              <li><b>Contributor:</b> It can only create, modify and delete posts and categories</li>
          </ul>
      </div>
  </div>

    </div>
</div>
</div>

<?php

if($operation=="mod"){
    ?>
<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">New user's password</h6>
       

        </div>
        <div class="card-body">

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
                </div>
            </div>
        </form>
    </div>
</div>
</div>


<?php
}

?>
</div>