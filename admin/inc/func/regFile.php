
<div class="module">
    <div class="module-head">
        <h3>Add File</h3>
    </div>
    <div class="module-body">
  
       <form class="form-horizontal row-fluid" action="core/mngFile.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="operation" value="add" />

            <div class="control-group">
                <label class="control-label" for="title">File Title</label>
                <div class="controls">
                    <input type="text" id="title" name="title" placeholder="Choose the file title" class="span8">
                     
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="file">Upload file</label>
                <div class="controls">
                    <input type="file" id="myfile" name="myfile">
                </div>
                
            </div>
            <?php
            $cat= new DocCategories($db);
            $stmt = $cat->showAll();
            $total_rows = $cat->countAll();
            ?>
            <div class="control-group">
                <label class="control-label" for="category_id">Category</label>
            <div class="controls">
            
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
