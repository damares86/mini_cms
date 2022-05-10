<?php
    require "core/config.php";

	$database = new Database();
	$db = $database->getConnection();

	$page = new Page($db);
    
    $stmt = $page->showAllDefault();
    
    $total_rows=$page->countAll();

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$allpage_title?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$allpage_box_title?></h6>
        </div>
        <div class="card-body">
            <!-- <a href="index.php?man=page&op=add" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text"><?=$allpage_add?></span>
            </a> -->
            <br>
            <br>

        
        <?php

    if($total_rows>0){

        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?=$allpage_name?></th>
                    <th scope="col"><?=$allpage_link?></th>
                    <th scope="col"><?=$txt_edit?></th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
        if($id!=3){
        ?>
            <tr>
                <td><?=$page_name?></td>
                <?php
                    $str=$page_name;
                    $str = preg_replace('/\s+/', '_', $str);

                    $str = strtolower($str);
                ?>
                <td>
                    <?php
                    if($id!=7){
                    ?>
                    <a href="../<?=$str?>.php"><?=$allpage_view?></a>
                    <?php
                    }
                    ?>
                </td>

                <td>
                <a href="index.php?man=page&op=edit&idToMod=<?=$row["id"]?>" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen"></i>
                            </span>
                            <span class="text"><?=$txt_edit?></span>
                        </a>   
                <td>
             
            </tr>
                          
<?php
            }
        }

            ?>

            </tbody>
        </table>
        <?php
        // paging buttons
        // include_once 'inc/paging.php';
    } else{
        echo "<div class='alert alert-danger'>$allpage_nopage</div>";
    }


?>

    </div>
</div>
</div>
</div>