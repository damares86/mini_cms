<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$page = new Page($db);
    
    $stmt = $page->showAll($from_record_num, $records_per_page);
    
    $total_rows=$page->countAll();

?>
<script type="text/javascript" src="scripts/editable_table/jquery.tabledit.js"></script>

<div class="module">
    <div class="module-body">

        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Menu Item</h1>
            <!-- <a href="index.php?man=page&op=add"><button type="button" class="btn btn-success">Add new page +</button></a> -->
        </div>
        <br>
        
        <?php

    if($total_rows>0){

        ?>
        <table id="data_table" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Page Name</th>
                    <th scope="col">In menu</th>
                    <th scope="col">Item order</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Child of</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
        ?>
            <tr>
                <td><?=$id?></td>
                <td><?=$page_name?></td>
                <td><?=$in_menu?></td>
                <td><?=$item_order?></td>
                <td><?=$parent?></td>
                <td><?=$child_of?></td>
               
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
        echo "<div class='alert alert-danger'>No page found.</div>";
    }


?>

    </div>
</div>
<script type="text/javascript" src="scripts/editable_table/custom_table_edit.js"></script>

