  <!-- Footer -->
  <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Mini Cms Church <?=$mc_version?> - Fork di Mini Cms, un progetto  &nbsp; <a href="https://www.dmweblab.com"><img src="assets/img/dmweblab_logo.png"></a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
			<script src="scripts/my-login.js"></script>

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

<script type="text/javascript">
function postForm() {
    <?php
    for($i=1;$i<=$counter;$i++){
    ?>

	$('textarea[name="editor<?=$i?>"]').html($('#editor<?=$i?>').code());
    <?php
    }
    ?>
}
</script>
</body>

</html>