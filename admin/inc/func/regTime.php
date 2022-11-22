<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$time_title_mod?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">
<?php
                            $stmt= $time->showAll();
                            while($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>  
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
      
        <form class="form-horizontal row-fluid" action="core/mngTime.php" method="post">
            <div class="control-group">
                <div class="controls">
                    <h4><?=$time_mass?></h4>
                    <textarea id="editor1" name="editor" rows="10">
                        <?php
                            echo $row['mass'];
                        ?>
                    </textarea>
                </div>
            </div>
            
            <br>

            <div class="control-group">
                <div class="controls">
                    <h4><?=$time_office?></h4>
                    <textarea id="editor2" name="editor2" rows="10">
                        <?php
                            echo $row['office'];
                        ?> 
                    </textarea>
                </div>
            </div>
            <?php
                }
            ?>
            <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">
        </form>

        

    </div>
</div>
</div>
</div>