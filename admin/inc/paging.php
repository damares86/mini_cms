<?php
// page given in URL parameter, default page is one
$pageNum = isset($_GET['page']) ? $_GET['page'] : 1; 
  
// $man=filter_input(INPUT_GET,"man");
// set number of records per page
$records_per_page = 5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $pageNum) - $records_per_page;

echo "<ul class=\"pagination justify-content-center\">";
  
// button for first page
if($pageNum>1){
    echo "<li class=\"page-item\"><a class=\"page-link\" href='?man=".$manage."&op=show&type={$type}' title='Go to the first page.'>";
        echo "First Page";
    echo "</a></li>";
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
            echo "<li class='active page-item'><a class=\"page-link\" href=\"#\">$x </a></li>";
        }
  
        // not current page
        else {
            echo "<li class=\"page-item\"><a class=\"page-link\" href='?man=".$manage."&op=show&page=$x&type={$type}'>$x</a></li>";
        }
    }
}
  
// button for last page
if($pageNum<$total_pages){
    echo "<li class=\"page-item\"><a class=\"page-link\" href='?man=".$manage."&op=show&page={$total_pages}&type={$type}' title='Last page is {$total_pages}.'>";
        echo "Last Page";
    echo "</a></li>";
}
  
echo "</ul>";
?>