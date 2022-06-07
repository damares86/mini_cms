<?php

// require '../../phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));

include("../../class/Database.php");
include("../../class/Settings.php");

$database = new Database();
$db = $database->getConnection();
$settings = new Settings ($db);

$stmt =$settings->showSettings();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="damares86">
    <link rel="icon" href="assets/img/favicon.ico" type="image/png"/>

    <title>Blocca sito</title>

    <!-- Custom fonts for this template-->
    <!-- per le modali -->
    <!-- <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script> -->
        <script src="../../scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

            <!-- Custom styles for this template-->
            <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">-->
           
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

            <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
            <link href="../../assets/css/custom.css" rel="stylesheet">
            <script>
    // $(document).ready(function(){
    //     $(".btn").click(function(){
    //         $("#myModal").modal('show');
    //     });
    // });
</script>

</head>
<body>
    <div class="container">
        <div class="row mx-auto my-5 justify-content-center border rounded-xl">
            
            <div class="col-6 mx-auto p-5 border-right">
                <h1 class="mb-5">Blocca il sito</h1>    
                    <?php
                            
                            
                            
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                
                                extract($row);
                                $checked="";
                                
                                if($row['dm']==0){
                                    $checked="checked";
                                }
                                ?>
                <form class="form-horizontal row-fluid" action="../../core/mngSettings.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="1" />
                    <input type="checkbox" name="dm" value="1" <?=$checked?>> Seleziona<br><br>
                    <div class="control-group">
                        <div class="controls">
                        
                            <input type="submit" class="btn btn-primary" name="subRegCheck" value="Invia">

                            <!-- <button type="submit" class="btn" name="subReg">Submit Form</button> -->
                        </div>
                    </div>
                </form>
                <?php
                }
                ?>
            </div>
            <div class="col-6 mx-auto p-5">
            <div class="row">
                    <div class="col-12 p-5 border-bottom">
                        <h1 class="mb-5">Backup Database</h1> 
                        <form class="form-horizontal row-fluid" action="../../scripts/backup/backup.php" method="POST" enctype="multipart/form-data">
                            <div class="control-group">
                                <div class="controls">
                                
                                    <input type="submit" class="btn btn-primary" name="subBackup" value="Backup DB">

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 p-5">
                        <h1 class="mb-5">Destroy</h1> 
                        <form class="form-horizontal row-fluid" action="../../core/mngSettings.php" method="POST" enctype="multipart/form-data">
                            <div class="control-group">
                                <div class="controls">
                                
                                    <input type="submit" class="btn btn-primary" name="subDestroy" value="Destroy">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
</body>
</html>

