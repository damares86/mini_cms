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

// loading class
include("../class/Database.php");
include("../class/User.php");
include("../class/Settings.php");

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$settings = new Settings($db);

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

    $where="AND (username LIKE '%".$query."%' OR email LIKE '%".$query."%')";

    $total_rows=$user->countFetch($where);
}else{
    $total_rows=$user->countAll();
}


    $stmt = $user->showAll($from_record_num, $records_per_page,$where);
    // print_r($pageNum);
    // exit;

    if($total_rows > 0){
        // print_r($allpage_name);
        // exit;
        
        $output.='
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">'.$alluser_username.'</th>
                <th scope="col">'.$alluser_email.'</th>
                <th scope="col">'.$alluser_role.'</th>
                <th scope="col">'.$alluser_login.'</th>
                <th scope="col">'.$txt_edit.'</th>
                <th scope="col">'.$txt_delete.'</th>
            </tr>
        </thead>
        <tbody>';
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
           extract($row);

           $output.=' <tr>
                <td>'.$username.'</td>
                <td>'.$email.'</td>
                <td>'.$rolename.'</td>
                <td>'.$last_login.'</td>
                <td>

                <a href="index.php?man=user&op=edit&idToMod='.$row['id'].'" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen"></i>
                            </span>
                            <span class="text">'.$txt_edit.'</span>
                        </a>   
    
                </td>
                <td>           
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
                          <div class="modal-body">'.$alluser_modal_text.'</div>
                          <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">'.$txt_cancel.'</button>
                              <a class="btn btn-primary" href="core/mngUser.php?idToDel='.$row["id"].'">Ok</a>
                          </div>
                      </div>
                  </div>
              </div>';
          
            $output.="</td>";

        }
        $output.="</tbody></table>";
        // $pageNum = isset($_GET['page']) ? $_GET['page'] : 1; 
        
        // $man=filter_input(INPUT_GET,"man");
        // set number of records per page
        $records_per_page = 5;
        
        // calculate for the query LIMIT clause
        $from_record_num = ($records_per_page * $pageNum) - $records_per_page;

        $manage="users";
        $type="custom";

        $output.="<ul class=\"pagination justify-content-center\">";
        // button for first page
        if($pageNum>1){
            $output.="<li class=\"page-item\"><a class=\"page-link\" href='?man=".$manage."&op=show' title='Go to the first page.'>$txt_first_page</a></li>";
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
                    $output.="<li class=\"page-item\"><a class=\"page-link\" href='?man=".$manage."&op=show&page=$x'>$x</a></li>";
                }
            }
        }
        // button for last page
        if($pageNum<$total_pages){
            $output.="<li class=\"page-item\"><a class=\"page-link\" href='?man=".$manage."&op=show&page={$total_pages}' title='Last page is {$total_pages}.'>$txt_last_page</a></li>";
        }
        $output.="</ul>";
        echo $output;
    }else{
        echo '<div class="alert alert-danger">'.$alluser_nouser.'</div>';
    }