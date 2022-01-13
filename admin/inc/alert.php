<?php

$msg=filter_input(INPUT_GET,"msg");

if($msg=="userSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Cliente registrato correttamente
    </div>

    <?php    
} else if($msg=="userModSucc"){
    ?>
   <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Cliente modificato correttamente
    </div>

    <?php
}else if($msg=="userErr"){
    ?>
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Utente non registrato
    </div>

    <?php
}else if($msg=="prodSucc"){
    ?>
   <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Prodotto registrato correttamente
    </div>

    <?php
} else if($msg=="prodModSucc"){
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Prodotto modificato correttamente
    </div>

    <?php
}else if($msg=="prodErr"){
    ?>
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Prodotto non registrato
    </div>


    <?php
}else if($msg=="emptyUser"){
    ?>
     <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Alcuni dati mancanti, registrazione fallita
    </div>


    <?php
}else if($msg=="emptyProd"){
    ?>
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Nome prodotto mancante
    </div>


    <?php
}else if($msg=="emptyPass"){
    ?>
     <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Password mancante, utente non registrato
    </div>


    <?php
}else if($msg=="usernameErr"){
    ?>
     <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Username non valido
    </div>


    <?php
}else if($msg=="passErr"){
    ?>
     <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        La password deve essere tra 5 e 20 caratteri
    </div>


    <?php
}else if($msg=="usernameExist"){
    ?>
     <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Username già esistente
    </div>

    <?php
}else if($msg=="stmtErr"){
    ?>
      <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Mysql error
    </div>

    <?php
} else if($msg=="delSucc"){
    $obj=filter_input(INPUT_GET,"obj");
    if($obj=="user"){
        ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Cliente cancellato correttamente
    </div>
    <?php
    } else if($obj=="prod"){
        ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Prodotto cancellato correttamente
    </div>

    <?php
    } 
    
}else if($msg=="delErr"){
    $obj=filter_input(INPUT_GET,"obj");
    if($obj=="user"){
        ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Cliente non cancellato
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    } else if($obj=="prod"){
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Prodotto non cancellato
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
} 

?>
