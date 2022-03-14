<?php

$operation = "add";
$titoloForm = "Add New Post";

$postToMod="";
$idToMod="";
$category_id="";

if(filter_input(INPUT_GET,"idToMod")){
    $idToMod = filter_input(INPUT_GET,"idToMod");
    $titoloForm="Edit Post";
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
        <form id="postForm" class="form-horizontal row-fluid" action="core/mngPost.php" method="post"  onsubmit="return postForm()">
        <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php 
        $post->id = $idToMod;
      

                if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                <?php 
                } 
        $post->showById();
        $category_id= $post->category_id;

        ?>
            <div class="control-group">
                <label class="control-label" for="title">Title</label>
                <div class="controls">
                    <input type="text" id="title" name="title" placeholder="Post's Title" value="<?=$post->title?>" class="span8">
                     
                </div>
            </div>
            <div class="control-group">
            <label for="category_id">Category</label>
            <?php
            $cat = new Categories($db);
                $stmt = $cat->showAllList();
                $total_rows = $cat->countAll();
              
                ?>
            <select name="category_id">
                <?php
               
               
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($id == $category_id) {
                        $selected = "selected";
                    }
                    echo "<option value='{$id}' $selected>{$category_name}</option>";

                }

                ?>
            </select>
            </div>
            <br>
            <h4>Summary</h4>
            <textarea id="summernote" name="editor" rows="10">
                <?=$post->summary?>        
            </textarea>
            
            <br>

            <h4>Content</h4>
            <textarea id="summernote2" name="editor2" rows="10">
                <?=$post->content?>        
            </textarea>
            <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="Submit">
        </form>

        

    </div>
</div>
</div>
</div>