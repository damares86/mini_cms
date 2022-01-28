<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$page = new Page($db);
    
    $stmt = $page->showAll($from_record_num, $records_per_page);

    $total_rows=$post->countAll();

?>
<div class="module">
    <div class="module-body">

        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Page</h1>
            <a href="index.php?man=page&op=add"><button type="button" class="btn btn-success">Add new page +</button></a>
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
                    <th scope="col">Category</th>
                    <th scope="col">Modified</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
           
            <tr>
                <td><?=$id?></td>
                <td><?=$title?></td>
                <td><?=$category_name?></td>
                <td><?=$modified?></td>
                <td><a href="index.php?man=post&op=edit&idToMod=<?=$row["id"]?>"><button type="button" class="btn btn-warning">Edit</button></a></td>
                <td><a href="core/mngPost.php?idToDel=<?=$row["id"]?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
            </tr>
      


            </tbody>
        </table>
        <?php
        // paging buttons
        include_once 'inc/paging.php';
    } else{
        echo "<div class='alert alert-danger'>No post found.</div>";
    }


?>

    </div>
</div>
