<?php

require '../phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));



session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../');
    exit;
}

spl_autoload_register('autoloader');
    function autoloader($class){
        include("../class/$class.php");
    }


$database = new Database();
$db = $database->getConnection();

include "../inc/class_initialize.php";

$stmt=$settings->showLangAndName();
$lang=$settings->dashboard_language;
foreach (glob("../locale/$lang/*.php") as $row){
    require "$row";
}

$where="";

$pageNum=filter_input(INPUT_POST,"num");
// set number of records per page
$records_per_page = 5;  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $pageNum) - $records_per_page;


if(filter_input(INPUT_POST,"query")){

    $query=filter_input(INPUT_POST,"query");

    $where=" WHERE page_name LIKE '%".$query."%' ";

    $total_rows=$page->countFetchCustom($where);
}else{
    $total_rows=$page->countAllCustom();
}


    $stmt = $page->showAllCustom($from_record_num, $records_per_page,$where);
    // print_r($pageNum);
    // exit;

    if($total_rows > 0){
        // print_r($allpage_name);
        // exit;
        
        $output.='
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">'.$allpage_name.'</th>
                <th scope="col">'.$allpage_link.'</th>
                <th scope="col">'.$txt_edit.'</th>
                <th scope="col">'.$txt_copy.'</th>
                <th scope="col">'.$txt_delete.'</th>
            </tr>
        </thead>
        <tbody>';
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
            extract($row);
            $str=$page_name;
            $str = str_replace('_',' ', $str);
            $str = ucfirst($str);
           
           $output.=' <tr>
                <td>'.$str.'</td>
                <td><a href="../'.$page_name.'.php">'.$allpage_view.'</a></td>
                <td>

                <a href="index.php?man=page&op=edit&idToMod='.$row["id"].'&type=custom&count='.$row["counter"].'" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen"></i>
                            </span>
                            <span class="text">'.$txt_edit.'</span>
                        </a>   
    
                </td>
                <td>   

                <a href="core/mngPage.php?op=copy&idToMod='.$row["id"].'" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-clone"></i>
                            </span>
                            <span class="text">'.$txt_copy.'</span>
                        </a>  
                </td>
                <td>';
            if($no_mod==0){
                $output.='               
                    <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete'.$row['id'].'">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">'.$txt_delete.'</span>
                    </a>
                    <!-- Delete Modal-->
                    <div class="modal fade" id="delete'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b>'.$txt_modal_title.'</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>
                          <div class="modal-body">'.$allpage_modal_text.'</div>
                          <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">'.$txt_cancel.'</button>
                              <a class="btn btn-primary" href="core/mngPage.php?idToDel='.$row["id"].'">Ok</a>
                          </div>
                      </div>
                  </div>
              </div>';
            }
            $output.="</td>";

        }
        $output.="</tbody></table>";
        // $pageNum = isset($_GET['page']) ? $_GET['page'] : 1; 
        
        // $man=filter_input(INPUT_GET,"man");
        // set number of records per page
        $records_per_page = 5;
        
        // calculate for the query LIMIT clause
        $from_record_num = ($records_per_page * $pageNum) - $records_per_page;

        $manage="page";
        $type="custom";

        $output.="<ul class=\"pagination justify-content-center\">";
        // button for first page
        if($pageNum>1){
            $output.="<li class=\"page-item\"><a class=\"page-link\" href='?man=".$manage."&op=show&type={$type}' title='Go to the first page.'>$txt_first_page</a></li>";
        }
        // count all products in the database to calculate total pages
        $total_pages = ceil($total_rows / $records_per_page);

        
        // range of links to show
        $range = 2;
        
        // display links to 'range of pages' around 'current page'
        $initial_num = $pageNum - $range;
        $condition_limit_num = ($pageNum + $range)  + 1;
        
        for ($x=$initial_num; $x<$condition_limit_num; $x++) {
        
            // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
            if (($x > 0) && ($x <= $total_pages)) {
        
                // current page
                if ($x == $pageNum) {
                    $output.="<li class='active page-item'><a class=\"page-link\" href=\"#\">$x </a></li>";
                }else{
                    $output.="<li class=\"page-item\"><a class=\"page-link\" href='?man=".$manage."&op=show&page=$x&type={$type}'>$x</a></li>";
                }
            }
        }
        // button for last page
        if($pageNum<$total_pages){
            $output.="<li class=\"page-item\"><a class=\"page-link\" href='?man=".$manage."&op=show&page={$total_pages}&type={$type}' title='Last page is {$total_pages}.'>$txt_last_page</a></li>";
        }
        $output.="</ul>";
 echo $output;
    }else{
        echo '<div class="alert alert-danger">'.$allpage_nopage.'</div>';
    }