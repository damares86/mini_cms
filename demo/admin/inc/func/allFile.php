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

      
                    <td>
                        <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete<?=$row['id']?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Delete</span>
                        </a>            
                    </td>
                    </tr>
                    <!-- Delete Modal-->
                 <div class="modal fade" id="delete<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure?</b></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">If you really want to delete this file click "Ok" below.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="core/mngFile.php?idToDel=<?=$row["id"] ?>">Ok</a>
                                </div>
                            </div>
                        </div>
                    </div>
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