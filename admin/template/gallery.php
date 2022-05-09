<?php
require "../../admin/template/inc/header_gallery.php";

?>
            <div id="bottomContainer">
                <div id="content">
                    <div class="row">
                        <div class="col-12 pt-5 text-center">
                            <h2><?=$portfolio->project_title?></h2>
                        </div>
                    </div>
                    <div class="row px-5">
                <?php
                $file = basename($_SERVER['PHP_SELF']);
                $page_class = pathinfo($file, PATHINFO_FILENAME);
                
              
                // Image extensions
                $image_extensions = array("png","jpg","jpeg","JPG");
                
                // INTERCETTARE IL NOME DELLA GALLERIA!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!11
                $gallery="";
                
                // Target directory
                $dir = "uploads/gallery/$gallery/";
                
                if (is_dir($dir)){
                
                    if ($dh = opendir($dir)){
                        $count = 1;
                
                        // Read files
                        while (($file = readdir($dh)) !== false){
                
                            if($file != '' && $file != '.' && $file != '..'){
                
                                // Thumbnail image path
                                $thumbnail_path = $dir.$file;
                
                                // Image path
                                $image_path = $dir.$file;
                
                                $thumbnail_ext = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
                                $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);
                
                                // Check its not folder and it is image file
                                if(!is_dir($image_path) && 
                                    in_array($thumbnail_ext,$image_extensions) && 
                                    in_array($image_ext,$image_extensions)){
                                ?>

                                <!-- Image -->
                                <a href="<?php echo $image_path; ?>">
                                <img src="<?php echo $thumbnail_path; ?>" alt="" title=""/>
                                </a>
                                <!-- --- -->
                                <?php
                
                                    // Break
                                    if( $count%4 == 0){
                                    ?>
                                        <div class="clear"></div>
                                    <?php 
                                    }
                                    $count++;
                                }
                            }
                
                        }
                    closedir($dh);
                    }
                }
                ?>
                    </div>
                 <!-- Script -->
                <script type='text/javascript'>
                $(document).ready(function(){
                
                 // Intialize gallery
                 var gallery = $('.gallery a').simpleLightbox();
                
                });
                </script>
                

              
         
                      
                
                    <div class="clearfix"></div>
                </div>
            </div>

<?php
require "../../admin/template/inc/footer.php";
?>