<?php
$fileCount=GetAllUserFileRows($conn,"files",$roleID);

?>

<div class="module">
    <div class="module-head">
        <h3>User dashboard</h3>
    </div>
    <div class="module-body">
        <p>
            Welcome <b><?=$user?></b> to your reserved area.</p>
            <p>Below you can see some information about you and the number of files you can download.<br>
            Click on the button Files or use the sidebar.<br></p>
            <p>Enjoy your time here!<br>
        </p>
    </div>
</div>
<div class="btn-controls">
    <div class="btn-box-row row-fluid">
        <div class="btn-box big span4">
            <i class=" icon-user"></i>
            <p class="text-muted">
                Username: <b><?=$user?></b>
            </p>
        </div>

        <div class="btn-box big span4">
            <i class=" icon-eye-open"></i>
            <p class="text-muted">
                Role: <b><?=$rolename?></b>
            </p>
        </div>


        <a href="index.php?man=file" class="btn-box big span4">
            <i class="icon-folder-open"></i>
            <p class="text-muted">
                Your files: <b><?=$fileCount?></b>
            </p>
        </a>

    </div>
</div>
