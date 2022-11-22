<?php
    
    $stmt = $time->showAll();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    extract($row);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Orari</h1>
</div>
<div class="row">

<!-- Content Column -->
    <div class="col-lg-12 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Orari Messe e Segreteria</h6>
            </div>
            <div class="card-body">
                <a href="index.php?man=time&op=add&count=2" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-pen"></i>
                    </span>
                    <span class="text">Modifica orari</span>
                </a>
                <br>
                <br>
                <div class="row">
                    <div class="col-6 border rounded">
                        <?php
                            echo $mass ;
                        ?>
                    </div>
                    <div class="col-6 border rounded">
                        <?php
                            echo $office ;
                        ?>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
<?php
}
?>