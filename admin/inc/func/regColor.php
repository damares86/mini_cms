<script type="text/javascript"> $(document).ready(function() { $('#colorpicker').farbtastic('#color'); }); </script>


<div class="module">
    <div class="module-head">
        <h3>Add new color</h3>
    </div>
    <div class="module-body">
        
    <div id="colorpicker"></div>
      
        <br>
        <form class="form-horizontal row-fluid" action="core/mngColor.php" method="POST" enctype="multipart/form-data">
      
            <div class="control-group">
                <label class="control-label" for="category_name">Color</label>
                <div class="controls">
                    <input type="text" id="color" name="color" value="#008db1" class="span8">
                     
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                   
                    <input type="submit" class="btn btn-primary" name="subReg" value="Submit">

                </div>
            </div>
        </form>
    </div>
</div>

