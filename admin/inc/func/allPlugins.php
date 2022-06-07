<?php
    require "core/config.php";


?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$plugin_title?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$plugin_box_title?></h6>
        </div>
        <div class="card-body">
            <form class="form-horizontal row-fluid" action="core/mngPlugins.php" method="POST" enctype="multipart/form-data">
                <div class="control-group" id="uploadPlugin">

                    <label class="control-label" for="file"><?=$plugin_upload?></label>
                    <div class="controls">
                        <input type="file" id="zip_file" name="zip_file">
                    </div>
                    
                </div>
                <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="submit" value="<?=$txt_submit?>">

                </div>
            </div>
            </form>

        <br>
        <div class="row">
        <?php
            $dir="plugins/";
            function is_dir_empty($dir) {
                if (!is_readable($dir)) return null; 
                return (count(scandir($dir)) == 2);
              }
                if( !is_dir($dir) || is_dir_empty($dir) ||is_dir_empty(($dir)) ){
                    echo "<div class='col'><div class='alert alert-danger'>$plugin_no</div></div>";
                }else{

                ?>

<table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?=$plugin_name?></th>
                    <th scope="col"><?=$plugin_desc?></th>
                    <th scope="col"><?=$plugin_manage?></th>
                    <th scope="col"><?=$plugin_enable?></th>
                </tr>
            </thead>
            <tbody>
            <?php
                    foreach (glob("$dir/*") as $file) {
                        $folder=pathinfo($file, PATHINFO_FILENAME);
                        require "plugins/$folder/config.php";
                        $plugin_name= str_replace("_"," ", $folder);
                        $plugin_name=ucfirst($plugin_name);
                        $plugins->plugin_name=$plugin_name;
                        $plugins->showByName();
                        $desc=$description;
                        $btn_install="btn-info";
                        $install=$plugin_btn_install;
                        $icon="fas fa-plus";
                        $btn_enable="btn-success";
                        $enable=$plugin_btn_enable;
                        $enable_icon = "fa fa-check";
                        $op_enable="enable";
                        $background="";
                        $url = "plugins/$folder/installer.php?op=add";
                        if($plugins->id){       
                            $desc= $plugins->description;
                            $btn_install="btn-danger";
                            $install=$plugin_btn_remove;
                            $icon="fas fa-trash";
                            $box_enabled=$plugin_D;
                            $box_enabled_color="danger";
                            $url = "plugins/$folder/installer.php?op=del&name=$folder";
                            if($plugins->active==1){
                                $box_enabled=$plugin_E;
                                $box_enabled_color="success";
                                $background="style='background-color:#bdeeff;'";
                                $btn_enable="btn-warning";
                                $enable=$plugin_btn_disable;
                                $enable_icon = "fa fa-times";
                                $op_enable="disable";
                            }
                        }
                        
                 


        ?>
            <tr <?=$background?>>
                <td>
                    <span class="bg-<?=$box_enabled_color?> p-1 text-white"><?=$box_enabled?></span> &nbsp; &nbsp;<?=$plugin_name?></td>
                <td><?=$desc?></td>
                <td>
                    <?php
                    if($plugins->id){
                    ?>
                        <a href="#" class="btn <?=$btn_install?> btn-icon-split" data-toggle="modal" data-target="#delete<?=$folder?>">

                    <?php
                    }else{
                    ?>
                    <a href="<?=$url?>" class="btn <?=$btn_install?> btn-icon-split">
                    <?php
                    }
                    ?>
                        <span class="icon text-white-50">
                            <i class="<?=$icon?>"></i>
                        </span>
                        <span class="text"><?=$install?></span>
                    </a>
                </td>
                <td>
                    <?php
                    if($plugins->id){
                    ?>
                    <a href="core/mngPlugins.php?name=<?=$plugin_name?>&op=<?=$op_enable?>" class="btn <?=$btn_enable?> btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="<?=$enable_icon?>"></i>
                        </span>
                        <span class="text"><?=$enable?></span>
                    </a>
                    <?php
                    }
                    ?>
                </td>

            </tr>
                          <!-- Delete Modal-->
                          <div class="modal fade" id="delete<?=$folder?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b><?=$txt_modal_title?></b></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body"><?=$plugin_modal_text?></div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><?=$txt_cancel?></button>
                                    <a class="btn btn-primary" href="<?=$url?>">Ok</a>
                                </div>
                            </div>
                        </div>
                    </div>


            </tbody>
        </table>
        <?php
                    }
        // paging buttons
        include_once 'inc/paging.php';
 
                }

?>
    </div>
</div>
</div>
</div>
</div>