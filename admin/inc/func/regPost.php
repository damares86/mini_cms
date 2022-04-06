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
        </div>
        <div class="card-body">
        <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#infoPost">
                        <span class="icon text-white-50">
                            <i class="fas fa-fw fa-question"></i>
                        </span>
                        <span class="text">Post creation info</span>
                    </a> <br>
             <!-- Info Modal-->
             <div class="modal fade" id="infoPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b>Post creation info</b></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body guide">
                                    When you create a new post, you can add a title and choose a category for the post. (If you need more categories, go to the "Categories" section). <br><br>
                                    Below there are two different editor:
                                        <ul>
                                            <li><b>Summary:</b> is for the preview of the post, that will be shown in the blog page where all the post will be shown, in the "Blog" page</li>
                                            <li><b>Content:</b> is for the content of the post, this will be shown by clicking <i>Continue reading -></i> at the end of the summary in the "Blog" page</li>
                                        </ul>
 
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
            <br>
           
            <br>
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