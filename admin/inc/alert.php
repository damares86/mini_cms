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
} else

?>
