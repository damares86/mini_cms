
<div class="module">
      
<div class="module-head">
<h3>Add Role</h3>
    </div>
    <div class="module-body">

        <div class="col-md-8 m-auto">
            <form action="core/mngRole.php" method="POST" enctype="multipart/form-data">
                <h3><?= $titoloForm ?></h3><br>
                <input type="hidden" name="operation" value="add" />
            
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
