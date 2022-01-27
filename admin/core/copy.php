<?php


$str="Contact Us";

$str = preg_replace('/\s+/', '_', $str);
$str = strtolower($str);


if(copy('prova.php', '../../prova.php')){
   rename('../../prova.php','../../'. $str . '.php');
   header("Location: ../../". $str . ".php");
   exit;
} else {
    echo "ko";
}

// recupera il nome del file

// $page = basename($_SERVER['PHP_SELF']);
// echo $page;

?>