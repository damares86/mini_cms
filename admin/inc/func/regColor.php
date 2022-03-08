<script type="text/javascript"> $(document).ready(function() { $('#colorpicker').farbtastic('#color'); }); </script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add new color</h1>

                    </div><div class="row">

<!-- Content Column -->
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
                <div id="colorpicker"></div>
            


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
</div>
</div>

