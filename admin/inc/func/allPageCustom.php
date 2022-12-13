<?php
    require "core/config.php";


?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$allpage_title?></h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$allpage_box_title?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <a href="index.php?man=page&op=add&type=custom" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text"><?=$allpage_add?></span>
                    </a>
                </div>
                <div class="col-9">
                    <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon">Search &nbsp;</span>
                        <input type="text" name="search_text" id="search_text" placeholder="Search pages..." class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <br>
        <div id="result"></div>
    
        <?php
        // paging buttons
        // include_once 'inc/paging.php';
?>
<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"core/fetchPage.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

    </div>
</div>
</div>
</div>