<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form per inserimento dati</title>
</head>
<body>
<h2>Il form é stato inviato correttamente</h2>
<p>Questi sono i dati inviati</p>
<?php
include ('config.php');
echo "<table>\n";
for($i=0;$i<count($fields);$i++) {
    echo "<tr>\n";
    echo "<td>\n";
    echo $fields[$i];
    echo "</td>\n";
    echo "<td>\n";
    if ($fields[$i] == "camera") {
        foreach ($_SESSION['sess_camera'] as $key => $value) {
            echo $value . "<br />\n";
        }
    } elseif ($fields[$i] == "permanenza") {
        echo $_SESSION['sess_' . $fields[$i]] . " giorni";
    } elseif ($fields[$i] == "messaggio") {
        echo nl2br ($_SESSION['sess_messaggio']);
    } else {
        echo $_SESSION['sess_' . $fields[$i]];
    }
    echo "</td>\n";
}
echo "</table>\n";
?>
<p><a href="pop_processo.php">torna indietro</a></p>
</body>
</html>