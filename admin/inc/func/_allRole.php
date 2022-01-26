<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$role = new Role($db);
    
    $stmt = $role->showAll($from_record_num, $records_per_page);

    $total_rows=$role->countAll();

?>
<div class="module">
    <div class="module-body">

        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Roles</h1>
            <a href="index.php?man=roles&op=add"><button type="button" class="btn btn-success">Add new role +</button></a>
        </div>
        <br>
        <?php

if($total_rows>0){
    ?>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Role's name</th>
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
                <td><?=$rolename?></td>

      
                        <td><a href="index.php?man=roles&op=edit&idToMod=<?=$row["id"] ?>"><button type="button" class="btn btn-primary">Edit</button></a></td>
                        <td><a href="core/mngRole.php?idToDel=<?=$row["id"] ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
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
        echo "<div class='alert alert-danger'>No role found.</div>";
    }


?>

    </div>
</div>
