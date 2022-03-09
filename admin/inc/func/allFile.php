<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$file = new File($db);
    
    $stmt = $file->showAll($from_record_num, $records_per_page);

    $total_rows=$file->countAll();

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Files manager</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All files</h6>
        </div>
        <div class="card-body">
        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <a href="index.php?man=files&op=add"><button type="button" class="btn btn-success">Add new file +</button></a>
        </div>
        <br>
        <?php

    if($total_rows>0){
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Name</th>
                    <th scope="col">Link</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row);
       
            ?>
            <tr>
                <td><?=$id?></td>
                <td><?=$title?></td>
                <td><?=$filename?></td>
                <td><a href="../uploads/<?=$filename?>" target="_blank">Link</a></td>

      
                        <td><a href="core/mngFile.php?idToDel=<?=$row["id"] ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
                    </tr>
                <?php
                }
                ?>


            </tbody>
        </table>
        <?php
        // paging buttons
        include_once 'paging.php';
    }
      
    // tell the user there are no products
    else{
        echo "<div class='alert alert-danger'>No file found.</div>";
    }


?>

    </div>
</div>
</div>
</div>