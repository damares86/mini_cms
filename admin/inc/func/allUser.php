<?php




    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$user = new User($db);
	$role = new Role($db);
    
    $stmt = $user->showAll($from_record_num, $records_per_page);

    $total_rows=$user->countAll();

        ?>
<div class="module">
    <div class="module-body">

        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Users</h1>
            <a href="index.php?man=users&op=add"><button type="button" class="btn btn-success">Add new user +</button></a>
        </div><br>
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
                            <a href="index.php?man=users&op=edit&idToMod=<?=$row["id"]?>">
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                            </a> &nbsp;
                           
                        </td>
                        <td>
                            <a href="core/mngUser.php?idToDel=<?=$row["id"]?>">
                                <button type="button" class="btn btn-danger btn-sm">Delete user</button>
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