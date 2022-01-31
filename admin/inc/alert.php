<?php

$msg=filter_input(INPUT_GET,"msg");

if($msg=="userDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        User successfully deleted
    </div>

    <?php    
} else if($msg=="userDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        User not deleted
    </div>

    <?php    
} else if($msg=="mailExists"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        User's email already registered
    </div>

    <?php    
} else if($msg=="userSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        User successfully registered
    </div>

    <?php    
} else if($msg=="userErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Error while registering user
    </div>

    <?php    
} else if($msg=="userEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        User successfully modified
    </div>

    <?php    
} else if($msg=="userEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        User not modified
    </div>

    <?php    
} else if($msg=="setEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Settings succesfully updated
    </div>

    <?php    
} else if($msg=="setEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Settings not modified
    </div>

    <?php    
} else if($msg=="postDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Post successfully deleted
    </div>

    <?php    
} else if($msg=="postDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Post not deleted
    </div>

    <?php    
} else if($msg=="postSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Post successfully inserted
    </div>

    <?php    
} else if($msg=="postErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Post not inserted
    </div>

    <?php    
} else if($msg=="postEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Post successfully modified
    </div>

    <?php    
} else if($msg=="postEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Post not modified
    </div>

    <?php    
} else if($msg=="userdelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        User successfully deleted
    </div>

    <?php    
} else if($msg=="catDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Category successfully deleted
    </div>

    <?php    
} else if($msg=="catDelError"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Category not deleted
    </div>

    <?php    
} else if($msg=="catExists"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Category already exists
    </div>

    <?php    
} else if($msg=="catSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Category successfully created
    </div>

    <?php    
} else if($msg=="catErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Category not created
    </div>

    <?php    
} else if($msg=="catEditSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Category successfully modified
    </div>

    <?php    
} else if($msg=="catEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Category not modified
    </div>

    <?php    
} else if($msg=="colorDelSucc"){
    ?>
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Color deleted
    </div>

    <?php    
} else if($msg=="colorDelErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Color not deleted
    </div>

    <?php    
} else if($msg=="colorSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Color created
    </div>

    <?php    
} else if($msg=="colorErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Color not created
    </div>

    <?php    
} else if($msg=="catEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Category name missing
    </div>

    <?php    
} else if($msg=="colorEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Color missing
    </div>

    <?php    
} else if($msg=="pageEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Page name or first block missing
    </div>

    <?php    
} else if($msg=="pswEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        New password missing
    </div>

    <?php    
} else if($msg=="postEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Post error: something missing
    </div>

    <?php    
} else if($msg=="settingsEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Title and description can't be empty
    </div>

    <?php    
} else if($msg=="userEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Some data missing during user creation
    </div>

    <?php    
} else

?>
