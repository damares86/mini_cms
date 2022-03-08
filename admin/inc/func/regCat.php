<?php

$operation = "add";
$titoloForm = "Add Category";

$catToMod="";
$idToMod="";

if(filter_input(INPUT_GET,"idToMod")){
    $idToMod = filter_input(INPUT_GET,"idToMod");
    $titoloForm="Edit Category";
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
        <div class="card-body">
        <form class="form-horizontal row-fluid" action="core/mngCat.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="operation" value="<?=$operation?>" />

        <?php 
      
        $cat = new Categories($db);
        $cat->id = $idToMod;
        

      
           if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                <?php 
                } 
        $cat->showById();

        ?>
            <div class="control-group">
                <label class="control-label" for="category_name">Category name</label>
                <div class="controls">
                    <input type="text" id="category_name" name="category_name" placeholder="Choose the category name" value="<?=$cat->category_name?>" class="span8">
                     
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
</div>
