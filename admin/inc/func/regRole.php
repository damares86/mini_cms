<?php

require_once "../core/functions.php";
$conn = OpenConnection();

$operation = "add";
$titoloForm = "Add Role";

$roleToMod="";


if (filter_input(INPUT_GET, "idToMod")) {
    $titoloForm = "Edit Role";

    $operation = "mod";
    $roleIDToMod = $_GET["idToMod"];
    $roleToMod =  GetDataById($conn, "roles", $roleIDToMod);
    if ($roleToMod) {
        $roleToModName = $roleToMod["rolename"];
    }
}

?> 

<div class="module">
    <div class="module-body">

        <div class="col-md-8 m-auto">
            <form action="core/mngRole.php" method="POST" enctype="multipart/form-data">
                <h3><?= $titoloForm ?></h3><br>
                <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php 
                if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $roleIDToMod ?>" />
                <?php 
                } 
                ?>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputRole_name"><b>Role's name</b></label>
                        <input type="text" class="form-control" id="rolename" name="rolename" value="<?= $roleToModName ?>">
                    </div>
                    <br>
                </div>

                <br>
                <input type="submit" class="btn btn-primary" name="subReg" value="Submit">

            </form>
        </div>

    </div>
</div>
