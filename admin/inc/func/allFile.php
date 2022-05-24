<?php
    require "core/config.php";

    $stmt = $file->showAll();

    $total_rows=$file->countAll();

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$file_title?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$file_box_title?></h6>
        </div>
        <div class="card-body">
        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <a href="index.php?man=files&op=add" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?=$file_add?></span>
            </a>
        </div>
        <br>
        <?php

    if($total_rows>0){
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?=$file_filetitle?></th>
                    <th scope="col"><?=$file_filename?></th>
                    <th scope="col"><?=$file_filelink?></th>
                    <th scope="col"><?=$txt_edit?></th>
                    <th scope="col"><?=$txt_delete?></th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row);
       
            ?>
            <tr>
                <td><?=$title?></td>
                <td><?=$filename?></td>
                <td><a href="../uploads/<?=$filename?>" target="_blank"><?=$file_filelink?></a></td>

                    <td>
                        <a href="index.php?man=files&op=edit&idToMod=<?=$id?>" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen"></i>
                            </span>
                            <span class="text"><?=$txt_edit?></span>
                        </a>            
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete<?=$row['id']?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text"><?=$txt_delete?></span>
                        </a>            
                    </td>
                    </tr>
                    <!-- Delete Modal-->
                 <div class="modal fade" id="delete<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b><?=$txt_modal_title?></b></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body"><?=$file_modal_text?></div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><?=$txt_cancel?></button>
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
        echo "<div class='alert alert-danger'>$file_nofile</div>";
    }


?>

    </div>
</div>
</div>
</div>