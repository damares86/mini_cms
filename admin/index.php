<?php
require "inc/header.php";


$manage=filter_input(INPUT_GET,"man");
$operation=filter_input(INPUT_GET,"op");


// $usersCount=GetAllRows($conn,"accounts");
// $filesCount=GetAllRows($conn,"files");

$user=$_SESSION['name'];
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
                                require "inc/alert.php";
                            

                            if($manage=="post"){
                                if($operation=="show"){
                                    require "inc/func/allPost.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regPost.php";
                                } 
                            } else if($manage=="users"){
                                if($operation=="show"){
                                    require "inc/func/allUser.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regUser.php";
                                }
                            } else if($manage=="files"){
                                if($operation=="show")
                                 require "inc/func/allFile.php";
                                else if($operation=="add"||$operation=="edit"){
                                 require "inc/func/regFile.php";
                                }
                            }else if($manage=="settings"||$manage=="menu"){
                                require "inc/func/allSettings.php";
                            }else if($manage=="cat"){
                                if($operation=="show"){
                                    require "inc/func/allCat.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regCat.php";
                                }
                            }else if($manage=="page"){
                                if($operation=="show"){
                                    require "inc/func/allPage.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regPage.php";
                                }
                            }else if($manage=="portfolio"){
                                if($operation=="show"){
                                    require "inc/func/allPortfolio.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regPortfolio.php";
                                }
                            }else if($manage=="color"){
                                if($operation=="show"){
                                    require "inc/func/allColor.php";
                                } else if($operation=="add"){
                                    require "inc/func/regColor.php";
                                }
                            }else{  
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
                                <p><?=$home_intro1?> <b><?=$user?></b> <?=$home_intro2?></p>
                                        <p><?=$home_intro3?></p><br>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                            <div class="col-xl-4 col-md-6 mb-4">
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
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <?=$home_tab2?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_post?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-marker fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $settings=new Settings($db);
                        $stmt = $settings->showSettings();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                            extract($row);
                        ?>
                             <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <?=$home_tab3?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$theme?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-image fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                       
                               
                            </div>

                        </div>

                        <div class="col-lg-4 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?=$quicklink?></h6>
                                </div>
                                <div class="card-body"> 
                                    <p>
                                        <a href="https://minicms.altervista.org/" target="_blank">&rarr; Mini Cms</a>:
                                        <?=$home_link1?>
                                    </p>
                                    <p>
                                        <a href="https://github.com/damares86/mini_cms" target="_blank">&rarr; GitHub</a>:
                                        <?=$home_link1?>
                                    </p>
                                </div>
                            </div>

                         

                        </div>
                    </div>

                <?php
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

<script type="text/javascript">
$(document).ready(function() {
	$('#summernote').summernote({
        toolbar: [
     ['style', ['style','bold', 'italic', 'underline', 'clear']],
     ['font', ['strikethrough', 'superscript', 'subscript']],
     ['color', ['color']],
     ['para', ['ul', 'ol', 'paragraph']],
     ['insert', [ 'ajaxfileupload', 'link', 'video', 'table']],
     ['misc', ['codeview']]
   ],
   dialogsInBody: true,
		height: "300px",
		styleWithSpan: false
	});

$('#summernote2').summernote({
    toolbar: [
     ['style', ['style','bold', 'italic', 'underline', 'clear']],
     ['font', ['strikethrough', 'superscript', 'subscript']],
     ['color', ['color']],
     ['para', ['ul', 'ol', 'paragraph']],
     ['insert', [ 'ajaxfileupload', 'link', 'video', 'table']],
     ['misc', ['codeview']]
   ],
   dialogsInBody: true,
   height: "300px",
		styleWithSpan: false,
	});

$('#summernote3').summernote({
    toolbar: [
     ['style', ['style','bold', 'italic', 'underline', 'clear']],
     ['font', ['strikethrough', 'superscript', 'subscript']],
     ['color', ['color']],
     ['para', ['ul', 'ol', 'paragraph']],
     ['insert', [ 'ajaxfileupload', 'link', 'video', 'table']],
     ['misc', ['codeview']]
   ],
   dialogsInBody: true,
		height: "300px",
		styleWithSpan: false
	});

$('#summernote4').summernote({
    toolbar: [
     ['style', ['style','bold', 'italic', 'underline', 'clear']],
     ['font', ['strikethrough', 'superscript', 'subscript']],
     ['color', ['color']],
     ['para', ['ul', 'ol', 'paragraph']],
     ['insert', [ 'ajaxfileupload', 'link', 'video', 'table']],
     ['misc', ['codeview']]
   ],
   dialogsInBody: true,
		height: "300px",
		styleWithSpan: false
	});

$('#summernote5').summernote({
    toolbar: [
     ['style', ['style','bold', 'italic', 'underline', 'clear']],
     ['font', ['strikethrough', 'superscript', 'subscript']],
     ['color', ['color']],
     ['para', ['ul', 'ol', 'paragraph']],
     ['insert', [ 'ajaxfileupload', 'link', 'video', 'table']],
     ['misc', ['codeview']]
   ],
   dialogsInBody: true,
		height: "300px",
		styleWithSpan: false
	});

$('#summernote6').summernote({
    toolbar: [
     ['style', ['style','bold', 'italic', 'underline', 'clear']],
     ['font', ['strikethrough', 'superscript', 'subscript']],
     ['color', ['color']],
     ['para', ['ul', 'ol', 'paragraph']],
     ['insert', [ 'ajaxfileupload', 'link', 'video', 'table']],
     ['misc', ['codeview']]
   ],
   dialogsInBody: true,
		height: "300px",
		styleWithSpan: false
	});

 
});

function postForm() {

	$('textarea[name="editor"]').html($('#summernote').code());
	$('textarea[name="editor2"]').html($('#summernote2').code());
	$('textarea[name="editor3"]').html($('#summernote3').code());
	$('textarea[name="editor4"]').html($('#summernote4').code());
	$('textarea[name="editor5"]').html($('#summernote5').code());
	$('textarea[name="editor6"]').html($('#summernote6').code());
}
</script>
</body>

</html>