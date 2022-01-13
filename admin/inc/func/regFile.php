<?php

require_once "../core/functions.php";
$conn = OpenConnection();


?> 

<div class="module">
    <div class="module-head">
        <h3>Add User</h3>
    </div>
    <div class="module-body">

        <form class="form-horizontal row-fluid" action="core/mngFile.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="operation" value="add" />

            <div class="control-group">
                <label class="control-label" for="username">File Title</label>
                <div class="controls">
                    <input type="text" id="title" name="title" placeholder="Choose the file title" class="span8">
                     
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="file">Upload file</label>
                <div class="controls">
                    <input type="file" name="myfile">
                </div>
                
            </div>


           
            <div class="control-group">
                <label class="control-label">Role</label>
                <div class="controls">
                <?php

                    $roles=GetAllRecords($conn,"roles");

                    foreach($roles as $row){

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
