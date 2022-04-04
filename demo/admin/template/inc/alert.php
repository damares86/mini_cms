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
} else if($msg=="errResetRequest"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Reset request already done. Check your email for the link or come back later and retry
    </div>

    <?php    
} else if($msg=="noResetDelete"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        There are problems with your reset request. Please contact us.
    </div>

    <?php    
} else if($msg=="noReset"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        There are problems with your reset request. Please contact us.
    </div>

    <?php    
} else if($msg=="errRecaptcha"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Sorry, you don't seem reliable, please try again or contact us.
    </div>

    <?php    
} else if($msg=="errPost"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Error while trying to login
    </div>

    <?php    
} else if($msg=="contactEmpty"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Please fill all the fields
    </div>

    <?php    
} else if($msg=="sentContact"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Mail successfully sent
    </div>

    <?php    
} else if($msg=="errSendContact"){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Error sending your email
    </div>

    <?php    
} else

?>
