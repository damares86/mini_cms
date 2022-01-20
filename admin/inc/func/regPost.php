<?php

$operation = "add";
$titoloForm = "Add New Post";

$postToMod="";
$idToMod="";

if(filter_input(INPUT_GET,"idToMod")){
    $idToMod = filter_input(INPUT_GET,"idToMod");
    $titoloForm="Edit Post";
    $operation="mod";
}

?>
<div class="module">
    <div class="module-head">
        <h3><?=$titoloForm?></h3>
    </div>
    <div class="module-body">
        <form class="form-horizontal row-fluid" action="core/mngPost.php" method="post">
        <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php 
        $post->id = $idToMod;

                if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                <?php 
                } 
        $post->showById();

        ?>
            <div class="control-group">
                <label class="control-label" for="title">Title</label>
                <div class="controls">
                    <input type="text" id="title" name="title" placeholder="Post's Title" value="<?=$post->title?>" class="span8">
                     
                </div>
            </div>
            <br>

            <textarea name="editor" id="editor" rows="10" cols="80">
            <?=$post->content?>
            </textarea>
            <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="Submit">
        </form>

        

    </div>
</div>
