<?php
session_start();
include ('config.php');
$go = "pop_processo.php?form=form";
unset ($_SESSION['sess_error']);
unset ($_SESSION['sess_nominativo']);
unset ($_SESSION['sess_indirizzo']);
unset ($_SESSION['sess_citta']);
unset ($_SESSION['sess_mail']);
unset ($_SESSION['sess_motivo']);        //    sel
unset ($_SESSION['sess_pagamento']);    //    sel
unset ($_SESSION['sess_giorno']);        //    sel
unset ($_SESSION['sess_mese']);            //    sel
unset ($_SESSION['sess_anno']);            //    sel
unset ($_SESSION['sess_data']);
unset ($_SESSION['sess_permanenza']);
unset ($_SESSION['sess_camera']);        //    check
unset ($_SESSION['sess_mezzo']);        //    radio
unset ($_SESSION['sess_messaggio']);
$values = array();
for($i=0;$i<count($fields);$i++) {
    $values[$fields[$i]] = $_REQUEST[$fields[$i]];    
}
$giorno = $_REQUEST['giorno'];
$mese = $_REQUEST['mese'];
$anno = $_REQUEST['anno'];
$errors = array();
foreach ($values as $key => $value) {
    if (in_array($key, $fields_request)) {
        if($value == "") {
            $errors[] = "<font color='RED'>E' necessario inserire il campo " . $key . "</font>";
        }
    }    
    if ($key == "mail") {
        if ($value != "") {
            // $value = htmlentities(get_magic_quotes_gpc() ? stripslashes($value) : $value);
            $_SESSION['sess_mail'] = $value;
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "<font color='RED'>Indirizzo E-Mail non valido</font>";
            }
        }
    } elseif ($key == "camera") {
        if (count($value) != 0) {
            $_SESSION['sess_camera'] = $value;
        }
    } elseif ($key == "data") {
        if ($giorno != "0" || $mese != "0" || $anno != "0") {
            $_SESSION['sess_giorno'] = $giorno;
            $_SESSION['sess_mese'] = $mese;
            $_SESSION['sess_anno'] = $anno;        
            if (checkdate($mese, $giorno, $anno)) {
                $_SESSION['sess_data'] = $giorno . "-" . $mese . "-" . $anno;
            } else {
                $errors[] = "<font color='RED'>Se la data viene inserita deve essere corretta</font>";
            }
        }
    } else {
        if ($value != "") {
            // $value = htmlspecialchars(get_magic_quotes_gpc() ? stripslashes($value) : $value);
            $_SESSION['sess_' . $key] = $value;
        }
    }    
}
if(count($errors) != 0){
    $_SESSION['sess_error'] = $errors;
} else {
    $go = "pop_processo_thanks.php";
}
header('Location: ' . $go);
//    ==================================================
echo count($errors) ." errori<br />\n";
echo implode (", ", $values) . "<br />\n";
echo "<a href=\"".$go."\">torna indietro</a><br />\n";
?>