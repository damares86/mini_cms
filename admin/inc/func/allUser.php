<?php




    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$user = new User($db);
	$role = new Role($db);
    
    $stmt = $user->showAll($from_record_num, $records_per_page);

    $total_rows=$user->countAll();

    if($total_rows>0){
        ?>
      
        <table class="table table-hover table-responsive table-bordered">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
      <?php 
    
    
       
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                extract($row);
               
              

                ?>
            <tr>
                <td><?=$id?></td>
                <td><?=$username?></td>
                <td><?=$email?></td>
                <td><?=$role_id?></td>
                <td>Edit</td>
                <td>Delete</td>
      
            </tr>
      <?php
            }
      ?>
        </table>
      <?php
        // paging buttons
        include_once 'paging.php';
    }
      
    // tell the user there are no products
    else{
        echo "<div class='alert alert-danger'>No products found.</div>";
    }


?>
