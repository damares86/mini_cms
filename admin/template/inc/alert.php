<?php

$msg=filter_input(INPUT_GET,"msg");

if($msg=="errSend"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Problems sending you an email.
    </div>

    <?php    
} else if($msg=="mailResetErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Email missing
    </div>

    <?php    
} else if($msg=="mailNotReg"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Email not registered
    </div>

    <?php    
} else if($msg=="pswEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        You have to write a new password
    </div>

    <?php    
} else if($msg=="newPass"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Password changed successfully. Login below
    </div>

    <?php    
} else if($msg=="pswEditErr"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Error while changing your password
    </div>

    <?php    
} else 

?>
