<?php
require "inc/header.php";

$manage="home";
if(filter_input(INPUT_GET,"man")){
    $manage=filter_input(INPUT_GET,"man");
}
$operation=filter_input(INPUT_GET,"op");
$type=filter_input(INPUT_GET,"type");


// $usersCount=GetAllRows($conn,"accounts");
// $filesCount=GetAllRows($conn,"files");

$user_name=$_SESSION['name'];
$user_id=$_SESSION['user_id'];


?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            require "inc/sidebar.php";
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               <?php
                
                    require "inc/topbar.php";
               ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php
                            $alert=glob("inc/alert/*.php", GLOB_BRACE);

                            foreach($alert as $row){
                                require "$row";
                            }
            
                            $stmt1=$home->showAll();

                       
                        if($manage=="users"){ // fuori 
                                if($operation=="show"){
                                    require "inc/func/allUser.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regUser.php";
                                }
                            } else if($manage=="files"){//fuori
                                if($operation=="show")
                                 require "inc/func/allFile.php";
                                else if($operation=="add"||$operation=="edit"){
                                 require "inc/func/regFile.php";
                                }
                            }else if($manage=="settings"||$manage=="menu"){// fuori
                                require "inc/func/allSettings.php";
                            }else if($manage=="cat"){
                                if($operation=="show"){
                                    require "inc/func/allCat.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regCat.php";
                                }
                            }else if($manage=="page"){ // fuori
                                if($operation=="show"){
                                    if($type=="default"){
                                        require "inc/func/allPage.php";
                                    } else if($type=="custom"){
                                        require "inc/func/allPageCustom.php";
                                    }
                                } else if($operation=="add"||$operation=="edit"){
                                    if($type=="default"){
                                        require "inc/func/regPage.php";
                                    } else if($type=="custom"){
                                        require "inc/func/regPageCustom.php";
                                    }
                                }
                            }else if($manage=="gall"){// fuori
                                if($operation=="show"){
                                    require "inc/func/allGallery.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regGallery.php";
                                }
                            }else if($manage=="plugins"){ // portfolio
                                if($operation=="show"){
                                    require "inc/func/allPlugins.php";
                                } 
                            }else if($manage=="home"){
                                ?>
        
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"><?=$home_title?></h1>
                            </div>
        
                            
                            <!-- Content Row -->
        
                            
                            <!-- Content Row -->
                            <div class="row">
        
                                <!-- Content Column -->
                                <div class="col-lg-8 mb-4">
        
                                    <!-- Project Card Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary"><?=$home_welcome?></h6>
                                        </div>
                                        <div class="card-body">
                                        <p><?=$home_intro1?> <b><?=$user_name?></b> <?=$home_intro2?></p>
                                                <p><?=$home_intro3?></p><br>
                                        </div>
                                    </div>
        
                                    <!-- Color System -->
                                    <div class="row">
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <a href="index.php?man=users&op=show">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            <?=$home_tab1?></div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_user?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
        
                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <a href="index.php?man=settings">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            <?=$home_tab2?></div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$lang?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-marker fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
             
                                     <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <a href="index.php?man=page&op=show&type=custom">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                <?=$home_tab3?></div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_pages?></div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-image fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                               
                                       
                                    </div>
        
                                </div>
        
                                <div class="col-lg-4 mb-4">
        
                                    <!-- Illustrations -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary"><?=$home_quicklink?></h6>
                                        </div>
                                        <div class="card-body"> 
                                            <p>
                                                <a href="https://docs.google.com/document/d/1ueqfbE5TEzNY-HnbNTx3_yq-gbmd0OuvLpVuREQzqwA/edit?usp=sharing" target="_blank">&rarr; Mini Cms</a>:
                                                <?=$home_link1?>
                                            </p>
                                            <p>
                                                <a href="https://www.dmweblab.com/" target="_blank">&rarr; DM WebLab</a>:
                                                <?=$home_link2?>
                                            </p>
                                        </div>
                                    </div>
        
                                 
        
                                </div>
                            </div>
        
                        <?php
                                    }else if($stmt1){
                                while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
                                    
                                    extract($row);
                                    
                                    $name_page = ucfirst($name_function);
                                    if($manage=="$name_function"){
                                        if($operation=="show"){
                                            require "inc/func/all$name_page.php";
                                        } else if($operation=="add"||$operation=="edit"){
                                            require "inc/func/reg$name_page.php";
                                        } 
                                    }
                            }
                        } 
                        ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

          <?php
            require "inc/footer.php";
          ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?=$txt_modal_title?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?=$txt_modal_logout?></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><?=$txt_cancel?></button>
                    <a class="btn btn-primary" href="core/logout.php"><?=$txt_logout?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="assets/vendor/jquery/jquery.min.js"></script> -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="scripts/sb-admin-2.min.js"></script>
    
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script type="text/javascript" src="scripts/farbtastic/farbtastic.js"></script>
    
    <script src="scripts/common.js" type="text/javascript"></script>

<!-- <script src="scripts/summernote/summernote.min.js"></script> -->
<?php
for($i=1;$i<=$counter;$i++){

echo '<script type="text/javascript">';
echo "\n";
echo '$(document).ready(function() {';
echo "\n";
echo "$('#summernote$i').summernote({";
echo "\n";
echo 'toolbar: [';
echo "\n";
echo "['style', ['style','bold', 'italic', 'underline', 'clear']],";
echo "\n";
echo "['font', ['strikethrough', 'superscript', 'subscript']],";
echo "\n";
echo "['color', ['color']],";
echo "\n";
echo "['para', ['ul', 'ol', 'paragraph']],";
echo "\n";
echo "['insert', [ 'ajaxfileupload', 'link', 'video', 'table']],";
echo "\n";
echo "['misc', ['codeview']]";
echo "\n";
echo '],';
echo "\n";
echo "dialogsInBody: true,";
echo "\n";
echo "height: '300px',";
echo "\n";
echo "styleWithSpan: false";
echo "\n";
echo "});";
echo "\n";
echo '})';
echo "\n";
echo '</script>';

}
?>

<script type="text/javascript">
function postForm() {
    <?php
    for($i=1;$i<=$counter;$i++){
    ?>

	$('textarea[name="editor<?=$i?>"]').html($('#summernote<?=$i?>').code());
    <?php
    }
    ?>
}
</script>
</body>

</html>