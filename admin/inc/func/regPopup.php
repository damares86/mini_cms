<?php
$operation = "add";
$titoloForm = "Add a new Popup"; ////////////////////

$popToMod="";
$idToMod="";

if(filter_input(INPUT_GET,"idToMod")){
    $idToMod = filter_input(INPUT_GET,"idToMod");
    $titoloForm="Edit a popup"; /////////////////////////
    $operation="mod";
}

$all_pages=$page->showAllPages();


?>



<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$titoloForm?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
  

        </div>
        <?php
        $page->id = $idToMod;

        $page->showById();

        // if(!isset($_SESSION["sess_old_page_name"])){
        //     $_SESSION["sess_old_page_name"]= $page->page_name;
        // }

        ?>

        <div class="card-body">
 
           
            <br>

        <form id="postForm" class="form-horizontal row-fluid" action="core/mngPage.php" method="post" enctype="multipart/form-data">


<?php
// if($operation=="add"){
//     if(!isset($_REQUEST['more'])){
//         $page->destroyCheckSessVar();
//     }

//     if(isset($_REQUEST['more'])&&$_REQUEST['more']=="yes"){
//         $page->page_name=$_SESSION['sess_page_name'];
//         $page->layout=$_SESSION['sess_layout'];
//         $page->header=$_SESSION['sess_header'];
//         // $page->img=$_SESSION['sess_img'];
//     }
// }else if($operation=="mod"&&!isset($_REQUEST['more'])){
//         $page->destroyCheckSessVar();
//         $_SESSION["sess_old_page_name"]= $page->page_name;

//         $name=$page->page_name;
//         $name=preg_replace("/\s+/", "_", $name);
//         $name=strtolower($name);

//         $json_file = 'inc/pages/'.$name.'.json';
//         $data = file_get_contents($json_file);
//         $json_arr = json_decode($data, true);

//         $page-> modCheckSessVar($json_arr);
// }
?>



        <input type="hidden" name="operation" value="<?= $operation ?>" />
               
                    <input type="hidden" name="idToMod" value="<?= $idToMod ?>" />
            
            <div class="control-group">
                <div class="control-label">
                    Popup title
                </div>
                <div class="controls">
<!--   -------------////////////////////////////////////////////////// -->
                    <input type="text" id="page_name" name="page_name" placeholder="Titolo del popup" value="<?=$_SESSION['sess_popup_name']?>" class="span8">                     
                </div>
            </div>

        <div class="control-group">



        <span style="font-weight:bold; font-size: 1.5em;">Contenuto</span> &nbsp; &nbsp;<br><br>

        <!-- TEXT BOX -->
        <div class="t1 box1">
            <?php
            $name="block$i";
            $page->$name=$_SESSION['sess_editor'.$i.''];
            ?>
            <textarea id="editor1" name="editor1" rows="10">   <?=$page->$var?></textarea>
            <br>


        </div>

            <br>
                 <input type="submit" class="btn btn-primary" name="subReg" value="<?=$txt_submit?>">
        </form>
        
        
    </div>
</div>
</div>
</div>