<?php
    require "core/config.php";


?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Plugins</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All plugins</h6>
        </div>
        <div class="card-body">
        <!-- <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <a href="index.php?man=gall&op=add" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Upload plugin</span>
            </a>
        </div> -->
        <br>
        <div class="row">
        <?php
            $dir="plugins/";
            function is_dir_empty($dir) {
                if (!is_readable($dir)) return null; 
                return (count(scandir($dir)) == 2);
              }
                if( !is_dir($dir) || is_dir_empty($dir) ||is_dir_empty(($dir)) ){
                    echo "<div class='col'><div class='alert alert-danger'>No plugins found</div></div>";
                }else{

                ?>

<table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Plugin name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Manage</th>
                    <th scope="col">Enable/Disable</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    foreach (glob("$dir/*") as $file) {
                        $folder=pathinfo($file, PATHINFO_FILENAME);
                        $plugin_name= str_replace("_"," ", $folder);
                        $plugin_name=ucfirst($plugin_name);
                        $plugins->plugin_name=$plugin_name;
                        $plugins->showByName();
                        $btn_install="btn-info";
                        $install="Install";
                        $btn_enable="btn-success";
                        $enable="Enable";
                        $op_enable="enable";
                        $background="";
                        $url = "plugins/$folder/installer.php?op=add";
                        if($plugins->id){                            
                            $btn_install="btn-danger";
                            $install="Remove";
                            $box_enabled="D";
                            $box_enabled_color="danger";
                            $url = "plugins/$folder/installer.php?op=del";
                            if($plugins->active==1){
                                $box_enabled="E";
                                $box_enabled_color="success";
                                $background="style='background-color:#bdeeff;'";
                                $btn_enable="btn-warning";
                                $enable="Disable";
                                $op_enable="disable";
                            }
                        }
                        
                 


        ?>
            <tr <?=$background?>>
                <td>
                    <span class="bg-<?=$box_enabled_color?> p-1 text-white"><?=$box_enabled?></span> &nbsp; &nbsp;<?=$plugin_name?></td>
                <td><?=$plugins->description?></td>
                <td>
                    <a href="<?=$url?>" class="btn <?=$btn_install?> btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-pen"></i>
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
                            <i class="fas fa-pen"></i>
                        </span>
                        <span class="text"><?=$enable?></span>
                    </a>
                    <?php
                    }
                    ?>
                </td>
              
                <!-- <td>
                        <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete<?=$id?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text"><?=$txt_delete?></span>
                        </a> 
                

            </td> -->
            </tr>
                          <!-- Delete Modal-->
                          <div class="modal fade" id="delete<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b><?=$txt_modal_title?></b></h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body"><?=$port_modal_text?></div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><?=$txt_cancel?></button>
                                    <a class="btn btn-primary" href="core/mngPortfolio.php?idToDel=<?=$id?>">Ok</a>
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