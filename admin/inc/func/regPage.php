<?php

$operation = "add";
$titoloForm = "Add New Page";

$postToMod="";
$idToMod="";
$category_id="";

if(filter_input(INPUT_GET,"idToMod")){
    $idToMod = filter_input(INPUT_GET,"idToMod");
    $titoloForm="Edit page";
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
        <?php
        $page->id = $idToMod;

        $page->showById();
        ?>

        </div>
        <div class="card-body">
           
            <br>

        <form class="form-horizontal row-fluid" action="core/mngPage.php" method="post">
        <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php 
      

                if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                    <?php 
                } 
                
                ?>
            <div class="control-group">
             
                <div class="controls">
                    <?php
                  if($operation=="mod"){
                            ?>
                    <strong><?= $page->page_name ?></strong>
                    <input type="hidden" name="page_name" value="<?= $page->page_name ?>" />
                    <?php
                       } else {
                    ?>

                    <input type="text" id="page_name" name="page_name" placeholder="Page Name" value="<?=$page->page_name?>" class="span8">

                    <?php
                       }
                    ?>
                     
                </div>
            </div>
            
            <br>
            <div class="control-group">
                <label class="control-label" for="layout">
                    Choose page layout
                </label>
                <div class="controls">
                    <?php
                    $pageLayout=$page->layout;
                   
                    foreach (glob("template/layout/*") as $file) {
                        if( is_file($file) ){
                            $style=pathinfo($file, PATHINFO_FILENAME);
                            $checked="";
                            if ($style == $pageLayout) {
                                $checked = "checked";
                            }
                            echo "<input type='radio' id='$style' name='layout' value='$style' $checked> <img src='template/layout/img/$style.png'> &nbsp; &nbsp; &nbsp;";

                        }
                    }
                ?>

                </div>
            </div>
            <br>
            <br>
            <h3>Block 1</h3>

            <textarea name="editor" id="editor" rows="10" cols="80">
            <?=$page->block1?>
            </textarea>
            <br>
            <div class="control-group">
            <label for="block1_bg">Background color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block1_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block1_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block1_text">Text color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block1_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block1_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>

            <br>
                 <!-- <input type="submit" class="btn btn-primary" name="subReg" value="Submit">
        </form> -->

            <hr>
            
        <!-- Editor for block 2 -->
        <!-- <form class="form-horizontal row-fluid" action="core/mngPage.php" method="post"> -->
            <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php       

                if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                <?php 
                } 

        ?>
            
            <br>
            <h3>Block 2</h3>
            <textarea name="editor2" id="editor2" rows="10" cols="80">
            <?=$page->block2?>
            </textarea>

            <br>

            <div class="control-group">
            <label for="block2_bg">Background color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block2_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block2_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block2_text">Text color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block2_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block2_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>
                 <!-- <input type="submit" class="btn btn-primary" name="subReg" value="Submit">
        </form> -->

        <!-- Editor for block 3 -->
        <!-- <form class="form-horizontal row-fluid" action="core/mngPage.php" method="post"> -->
            <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php       

                if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                <?php 
                } 

        ?>
            
            <br>
            <h3>Block 3</h3>
            <textarea name="editor3" id="editor3" rows="10" cols="80">
            <?=$page->block3?>
            </textarea>

            <br>
            <div class="control-group">
            <label for="block3_bg">Background color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block3_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block3_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block3_text">Text color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block3_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block3_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>
                 <!-- <input type="submit" class="btn btn-primary" name="subReg" value="Submit">
        </form> -->

        <!-- Editor for block 4 -->
        <!-- <form class="form-horizontal row-fluid" action="core/mngPage.php" method="post"> -->
            <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php       

                if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                <?php 
                } 

        ?>
            <br>
            <h3>Block 4</h3>
            <textarea name="editor4" id="editor4" rows="10" cols="80">
            <?=$page->block4?>
            </textarea>

            <br>
            <div class="control-group">
            <label for="block4_bg">Background color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block4_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block4_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block4_text">Text color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block4_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block4_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>

               <!-- Editor for block 5 -->
        <!-- <form class="form-horizontal row-fluid" action="core/mngPage.php" method="post"> -->
        <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php       

                if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                <?php 
                } 

        ?>
            <br>
            <h3>Block 5</h3>
            <textarea name="editor5" id="editor5" rows="10" cols="80">
            <?=$page->block5?>
            </textarea>

            <br>
            <div class="control-group">
            <label for="block5_bg">Background color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block5_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block5_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block5_text">Text color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block5_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block5_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>

               <!-- Editor for block 6 -->
        <!-- <form class="form-horizontal row-fluid" action="core/mngPage.php" method="post"> -->
        <input type="hidden" name="operation" value="<?= $operation ?>" />
                <?php       

                if($operation=="mod"){ 
                    ?>
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
                <?php 
                } 

        ?>
            <br>
            <h3>Block 6</h3>
            <textarea name="editor6" id="editor6" rows="10" cols="80">
            <?=$page->block6?>
            </textarea>

            <br>
            <div class="control-group">
            <label for="block6_bg">Background color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block6_bg">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block6_bg) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            <br><br>
            <label for="block6_text">Text color</label>
            <?php
                $color = new Colors($db);
                $stmt = $color->showAllList();
                $total_rows = $color->countAll();
              
                ?>
            <select name="block6_text">
                <?php
               
                echo "<option value='none'>none</option>";
                
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           
                    extract($row);
                  
                    $selected = "";
                    if ($color == $page->block6_text) {
                        $selected = "selected";
                    }
                    echo "<option value='{$color}' $selected style='background-color:{$color}'>{$color}</option>";

                }

                ?>
            </select>
            </div>


            <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="Submit">
        </form>
        
        
    </div>
</div>
</div>
</div>