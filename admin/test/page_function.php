

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
  var newrow='<!-- BLOCK '+count+' -->'+
            '<br>'+
        '<\?php'+
           '$checked_n'+count+'="checked";'+
            '$checked_t'+count+'="";'+
            '$checked_g'+count+'="";'+
            '$checked_b'+count+'="";'+
            '$type_arr = array("t","b","n");'+                
            'if($page->block'+count+'_type=="t"){'+
                '$checked_t'+count+'="checked";'+
                '$checked_n'+count+'="";'+
            '} else if($page->block'+count+'_type=="b"){'+
                '$checked_b'+count+'="checked";'+
                '$checked_n'+count+'="";'+
            '} else if($page->block'+count+'_type=="n"){'+
                '$checked_n'+count+' = "checked";'+
            '}else if($operation=="mod"&&!in_array($page->block'+count+'_type,$type_arr)){'+
                '$checked_g'+count+' = "checked";'+
                '$checked_n'+count+' = "";}'+
            'if($checked_t'+count+'=="checked"){'+
                '?>'+
            '<style>'+
           '.box'+count+'.t'+count+'{'+
                'display:block;}'+
            '</style>'+
            '<\?php'+
            '} else if($checked_t'+count+'=="checked"){'+
            '?>'+ 
            '<style>'+
            '.box'+count+'.t'+count+'{'+
                 'display:block;'+
             '</style>'+
             '<\?php'+
             '} else if($checked_g'+count+'=="checked"){'+
             '?> '+
             '<style>'+
             '.box'+count+'.g'+count+'{'+
                  'display:block;}'+
              '</style>'+
              '<\?php'+
              '} else if($checked_b'+count+'=="checked"){'+
              '?>'+
               '<style>'+
             '.box'+count+'.b'+count+'{'+
                  'display:block;}'+
              '</style>'+
              '<\?php'+
              '}'+
              '?>'+
        '<h3><\?=$regpage_block?> '+count+'</h3><br>'+
        '<!-- radio button -->'+
        '<label><input type="radio" name="block'+count+'[]" value="n'+count+'" <\?=$checked_n'+count+'?>> <\?=$regpage_none?></label>'+
        '<label><input type="radio" name="block'+count+'[]" value="t'+count+'" <\?=$checked_t'+count+'?>> <\?=$regpage_text_block?></label>'+
        '<label><input type="radio" name="block'+count+'[]" value="g'+count+'" <\?=$checked_g'+count+'?>> <\?=$regpage_gall?></label>'+
        '<\?php'+
            'if($postActive==1){'+
        '?>'+
        '<label><input type="radio" name="block'+count+'[]" value="b'+count+'" <\?=$checked_b'+count+'?>> <\?=$regpage_post?></label>'+
        '<\?php'+
         '}'+
        '?>'+
        '<br><br>'+        
        '<!-- EMPTY BOX -->'+
        '<div class="n'+count+' box'+count+'">&nbsp;</div>'+
        '<!-- TEXT BOX -->'+
        '<div class="t'+count+' box'+count+'">'+
            '<textarea id="summernote2" name="editor'+count+'" rows="10" class="summernote position-absolute">   <\?=$page->block'+count+'?></textarea>'
            '<br>'+
        '</div>'+
         '<!-- GALLERY BOX -->'+
         '<div class="g'+count+' box'+count+' p-3" style="background-color:#f8f9fc">'+
         '<\?=$regpage_choose_gall?>'+
            '<\?php'+
            '$dir_gall="../misc/gallery/img/";'+
            '$dir_root="../misc/gallery/";'+
                'if( !is_dir($dir_gall) || is_dir_empty($dir_gall) ||is_dir_empty(($dir_root)) ){'+
                    'echo "<div class="col"><div class="alert alert-danger">$gall_nogall</div></div>";'+
                '}else{'+
                    '?>'+
                    '<select name="block'+count+'_gall">'+
                        '<\?php'+
                        'echo "<option value="none">none</option>";'+
            'foreach (glob("../misc/gallery/img/*") as $file) {'+
                '$folder=pathinfo($file, PATHINFO_FILENAME);'+
                '$gallery= str_replace("_"," ", $folder);'+
                '$gallery=ucfirst($gallery);'+                
                '$images= scandir ($file);'+
                '$firstFile = $file ."/". $images[2];// because [0] = "." [1] = ".." '+
                '$selected ="";'+
                'if($page->block'+count+'_type==$folder){'+
                    '$selected="selected";'+
                '}'+
                'echo "<option value="$folder" $selected>$gallery</option>";'+
            '}'+
        '}'+        
        '?>'+
        '</select>'+
        '</div>'+              
        '<!-- BLOG BOX -->'+
        '<div class="b'+count+' box'+count+' p-3" style="background-color:#f8f9fc">'+
             '<\?=$regpage_post_desc?>'+
        '</div>'+
        '<!-- END BLOCK '+count+' -->';

    
  return newrow;
}
</script>
</body>