<?php


$str="Contact Us";
// risistemo la stringa
$str = preg_replace('/\s+/', '_', $str);
$str = strtolower($str);

// ottiene -> $str="contact_us

if(copy('master.php', '../../master.php')){
   rename('../../master.php','../../'. $str . '.php');
   chmod('../../'. $str . '.php',0777);
   header("Location: ../../". $str . ".php");
   exit;
} else {
    echo "ko";
}


// copia un file da una cartella all'altra
if(copy('dir/master.php', '../master.php')){
    // rinomina il file copiato (in questo caso uso la stringa che ho sistemato prima)
    rename('../master.php','../'. $str . '.php');
    // cambia i permessi di lettura e scrittura del file, per non avere problemi
    chmod('../'. $str . '.php',0777);
    echo "ok";
 } else {
     echo "ko";
 }
?>