<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$portfolio = new Portfolio($db);
    
    $stmt = $portfolio->showAll($from_record_num, $records_per_page);
    
    $total_rows=$portfolio->countAll();

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Portfolio</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All projects</h6>
        </div>
        <div class="card-body">
            <a href="index.php?man=portfolio&op=add" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add new project</span>
            </a>
            <br>
            <br>

        
        <?php

    if($total_rows>0){

        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Project title</th>
                    <th scope="col">Completed</th>
                    <th scope="col">Category</th>
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
                <td><?=$id?></td>
                <td><?=$project_title?></td>
                <td><?=$completed?></td>
                <td><?=$category?></td>
               
                <td>
                <a href="index.php?man=portfolio&op=edit&idToMod=<?=$row["id"]?>" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen"></i>
                            </span>
                            <span class="text"><?=$txt_edit?></span>
                        </a>   
                <td>
                        <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete<?=$id?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text"><?=$txt_delete?></span>
                        </a> 
                
                <?php
                }
           
                ?>
            </td>
            </tr>
                          <!-- Delete Modal-->
                          <div class="modal fade" id="delete<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b><?=$txt_modal_title?></b></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">If you really want to delete this project click "Ok"</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><?=$txt_cancel?></button>
                                    <a class="btn btn-primary" href="core/mngPortfolio.php?idToDel=<?=$id?>">Ok</a>
                                </div>
                            </div>
                        </div>
                    </div>


            </tbody>
        </table>
        <?php
        // paging buttons
        include_once 'inc/paging.php';
    } else{
        echo "<div class='alert alert-danger'>Nessun progetto trovato</div>";
    }


?>

    </div>
</div>
</div>
</div>