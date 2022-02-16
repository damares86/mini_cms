<?php
//include connection file 
include_once("core/menu/connection.php");
$sql = "SELECT * FROM `menu` order by itemorder asc";
$queryRecords = mysqli_query($conn, $sql) or die("error to fetch menu data");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="core/menu/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
</head>
<body>
<div class="module">
	<div class="module-body">
	<h1 class="h2 mx-auto text-center">Menu</h1>
		
<div id="msg" class="alert"></div>
<table id="employee_grid" class="table table-condensed table-hover table-striped bootgrid-table" width="60%" cellspacing="0">
   <thead>
      <tr>
         <th>Page Name</th>
         <th>In menu</th>
         <th>Order</th>
      </tr>
   </thead>
   <tbody id="_editable_table">
      <?php foreach($queryRecords as $res) :?>
      <tr data-row-id="<?php echo $res['id'];?>">
         <td class="editable-col" contenteditable="true" col-index='0' oldVal ="<?php echo $res['pagename'];?>"><?php echo $res['pagename'];?></td>
         <td class="editable-col" contenteditable="true" col-index='1' oldVal ="<?php echo $res['inmenu'];?>"><?php echo $res['inmenu'];?></td>
         <!-- <td class="editable-col" contenteditable="true" col-index='1' oldVal ="<?php //echo $res['inmenu'];?>"><input type="checkbox"></td> -->
         <td class="editable-col" contenteditable="true" col-index='2' oldVal ="<?php echo $res['itemorder'];?>"><?php echo $res['itemorder'];?></td>
      </tr>
	  <?php endforeach;?>
   </tbody>
</table>

</div>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$('td.editable-col').on('focusout', function() {
		data = {};
		data['val'] = $(this).text();
		data['id'] = $(this).parent('tr').attr('data-row-id');
		data['index'] = $(this).attr('col-index');
	    if($(this).attr('oldVal') === data['val'])
		return false;

		$.ajax({   
				  
					type: "POST",  
					url: "core/menu/server.php",  
					cache:false,  
					data: data,
					dataType: "json",				
					success: function(response)  
					{   
						//$("#loading").hide();
						if(!response.error) {
							$("#msg").removeClass('alert-danger');
							$("#msg").addClass('alert-success').html(response.msg);
						} else {
							$("#msg").removeClass('alert-success');
							$("#msg").addClass('alert-danger').html(response.msg);
						}
					}   
				});
	});
});

</script>