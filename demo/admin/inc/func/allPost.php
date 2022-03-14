<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$post = new Post($db);
    $cat = new Categories($db);
    $stmt = $post->showAll($from_record_num, $records_per_page);

    $total_rows=$post->countAll();

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Posts</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>
        </div>
        <div class="card-body">
            <a href="index.php?man=post&op=add" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add new post</span>
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
                    <th scope="col">Title</th>
                    <th scope="col">Post Link</th>
                    <th scope="col">Category</th>
                    <th scope="col">Modified</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row);
                 $cat->id = $category_id;

                 $cat->showById();
                                 
                 $category_name= $cat->category_name;

                 $post_title= preg_replace('/\s+/', '_', $title);
                 $post_title = strtolower($post_title);
       
            ?>
            <tr>
                <td><?=$id?></td>
                <td><?=$title?></td>
                <td><a href="../post.php?id=<?=$id?>&title=<?=$post_title?>">View</a></td>
                <td><?=$category_name?></td>
                <td><?=$modified?></td>
                <td>
                <a href="index.php?man=post&op=edit&idToMod=<?=$row["id"]?>" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-pen"></i>
                    </span>
                    <span class="text">Edit</span>
                </a>       
                </td>
                <td>
                <a href="core/mngPost.php?idToDel=<?=$row["id"]?>" class="btn btn-danger btn-icon-split">
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
    } else{
        echo "<div class='alert alert-danger'>No post found.</div>";
    }


?>

    </div>
</div>
</div>
</div>