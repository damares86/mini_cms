<?php




    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$user = new User($db);
	$role = new Role($db);
    
    $stmt = $user->showAll($from_record_num, $records_per_page);

    $total_rows=$user->countAll();

        ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Users</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
        </div>
        <div class="card-body">
            <a href="index.php?man=users&op=add" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add new user</span>
            </a>
            <br>
            <br>


        <?php

if($total_rows>0){
    ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Edit</th>
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
                <td><?=$username?></td>
                <td><?=$email?></td>
                <td><?=$rolename?></td>
                <td>
                        <a href="index.php?man=users&op=edit&idToMod=<?=$row["id"]?>" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen"></i>
                            </span>
                            <span class="text">Edit</span>
                        </a>   
                        </td>
                        
                        <td>
                        <a href="core/mngUser.php?idToDel=<?=$row["id"]?>" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Delete</span>
                        </a>
                    
                        </td>
               
      
            </tr>
      <?php
            }
      ?>
        
     </tbody>
</table>

      <?php
        // paging buttons
        include_once 'inc/paging.php';
    }
      
    // tell the user there are no products
    else{
        echo "<div class='alert alert-danger'>No products found.</div>";
    }


?>

    </div>
</div>
</div>
</div>