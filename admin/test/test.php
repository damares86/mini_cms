

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
<body>
<div id="container">
<div class="row">
    <div class="col-md-4">
        <div class="form-group label-floating">
            <label class="control-label">Act</label>
            <input type="text" class="form-control" v-model="act" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group label-floating">
            <label class="control-label">Section </label>
            <input type="text" class="form-control" v-model="section">
        </div>
    </div>
    
</div>
</div>
<button id="btn">Add row</button>


<script>
var count=1;
$("#btn").click(function(){
  
  $("#container").append(addNewRow(count));
  count++;

});

function addNewRow(count){
  var newrow='<div class="row">'+
    '<div class="col-md-4">'+
        '<div class="form-group label-floating">'+
            '<label class="control-label">Act '+count+'</label>'+
            '<input type="text" class="form-control" v-model="act" >'+
        '</div>'+
    '</div>'+
    '<div class="col-md-4">'+
        '<div class="form-group label-floating">'+
            '<label class="control-label">Section '+count+'</label>'+
            '<input type="text" class="form-control" v-model="section">'+
        '</div>'+
    '</div>'+    
'</div>';
  return newrow;
}
</script>
</body>