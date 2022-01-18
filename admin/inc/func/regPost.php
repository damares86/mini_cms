
<div class="module">
    <div class="module-head">
        <h3>Add New Post</h3>
    </div>
    <div class="module-body">
        <form class="form-horizontal row-fluid" action="core/mngPost.php" method="post">
            <div class="control-group">
                <label class="control-label" for="title">Title</label>
                <div class="controls">
                    <input type="text" id="title" name="title" placeholder="Post's Title" class="span8">
                     
                </div>
            </div>
            <br>

            <textarea name="editor" id="editor" rows="10" cols="80">
            Write here your post.
            </textarea>
            <br>
            <input type="submit" class="btn btn-primary" name="subReg" value="Submit">
        </form>

        

    </div>
</div>
