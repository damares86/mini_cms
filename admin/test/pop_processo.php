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
<?php
$nominativo = "";
$indirizzo = "";
$citta = "";
$mail = "";
$motivo = "";
$pagamento = "";
$giorno = "";
$mese = "";
$anno = "";
$permanenza = "";
unset ($camera);
$mezzo = "";
$messaggio = "";
if (isset($_REQUEST['form']) && $_REQUEST['form'] == "form") {
    if ($_SESSION['sess_error']) {
        $nominativo = ($_SESSION['sess_nominativo']);
        $indirizzo = ($_SESSION['sess_indirizzo']);
        $citta = ($_SESSION['sess_citta']);
        $mail = ($_SESSION['sess_mail']);
        $motivo = ($_SESSION['sess_motivo']);        //    sel
        $pagamento = ($_SESSION['sess_pagamento']);    //    sel
        $giorno = ($_SESSION['sess_giorno']);        //    sel
        $mese = ($_SESSION['sess_mese']);            //    sel
        $anno = ($_SESSION['sess_anno']);            //    sel
        $permanenza = ($_SESSION['sess_permanenza']);
        $camera = ($_SESSION['sess_camera']);        //    check
        $mezzo = ($_SESSION['sess_mezzo']);        //    radio
        $messaggio = ($_SESSION['sess_messaggio']);
        foreach ( $_SESSION['sess_error'] as $valore) {
            echo $valore . "<br />\n";
        }
    }
}
?>
<h2>Il form per l'inserimento dei dati</h2>
<form method="post" name="modulo" action="pop_processo_post.php">
<table class="tabella_it">
<tr>
<td colspan="2">Modulo o Form di esempio</td>
</tr>
<tr>
<td>Nominativo (*)</td>
<td><input type="text" name="nominativo" value="<?php echo $nominativo; ?>" size="45" /></td>
</tr>
<tr>
<td>Indirizzo</td>
<td><input type="text" name="indirizzo" value="<?php echo $indirizzo; ?>" size="45" /></td>
</tr>
<tr>
<td>Città</td>
<td><input type="text" name="citta" value="<?php echo $citta; ?>" size="45" /></td>
</tr>
<tr>
<td>E-Mail (*)</td>
<td><input type="text" name="mail" value="<?php echo $mail; ?>" size="45" /></td>
</tr>
<tr>
<td>Motivo contatto (*)</td>
<td>
<select name="motivo">
<option value="">Scegli</option>
<option value="info" <?php echo ($motivo == 'info' ? "selected='selected'" : "" ) ?>>Informazioni</option>
<option value="prenota" <?php echo ($motivo == 'prenota' ? "selected='selected'" : "" ) ?>>Prenotazione</option>
<option value="disp" <?php echo ($motivo == 'disp' ? "selected='selected'" : "" ) ?>>Disponibilita</option>
<option value="prev" <?php echo ($motivo == 'prev' ? "selected='selected'" : "" ) ?>>Preventivo</option>
</select>
</td>
</tr>
<tr>
<td>Tipo pagamento</td>
<td>
<select name="pagamento">
<option value="">Scelta tipo pagamento</option>
<option value="Contanti" <?php echo ($pagamento == 'Contanti' ? "selected='selected'" : "" ) ?>>Contanti</option>
<option value="Assegno" <?php echo ($pagamento == 'Assegno' ? "selected='selected'" : "" ) ?>>Assegno</option>
<option value="Bonifico" <?php echo ($pagamento == 'Bonifico' ? "selected='selected'" : "" ) ?>>Bonifico</option>
<option value="Carta_credito" <?php echo ($pagamento == 'Carta_credito' ? "selected='selected'" : "" ) ?>>Carta credito</option>
<option value="Altro" <?php echo ($pagamento == 'Altro' ? "selected='selected'" : "" ) ?>>Altro</option>
</select>
</td>
</tr>
<tr>
<td>Data arrivo</td>
<td>
<?php
$mesi = array (
    "01" => "Gennaio",
    "02" => "Febbraio",
    "03" => "Marzo",
    "04" => "Aprile",
    "05" => "Maggio",
    "06" => "Giugno",
    "07" => "Luglio",
    "08" => "Agosto",
    "09" => "Settembre",
    "10" => "Ottobre",
    "11" => "Novembre",
    "12" => "Dicembre"
);
echo "<select name=\"giorno\">\n";
echo "<option value=\"0\">Giorno</option>\n";
for($i=1;$i<32;$i++) {
    echo "<option value=\"".$i."\"" . ($giorno == $i ? " selected='selected'" : "") . ">".$i."</option>\n";
}
echo "</select>\n";
echo "<select name=\"mese\">\n";
echo "<option value=\"0\">Mese</option>\n";
foreach ($mesi as $key => $value) {
    echo "<option value=\"".$key."\"" . ($mese == $key ? " selected='selected'" : "") . ">".$value."</option>\n";
}
$cur_year = date ("Y");
echo "</select>\n";
echo "<select name=\"anno\">\n";
echo "<option value=\"0\">Anno</option>\n";
echo "<option value=\"".$cur_year."\"" . ($anno == $cur_year ? " selected='selected'" : "") . ">".$cur_year."</option>\n";
echo "<option value=\"".($cur_year+1)."\"" . ($anno == ($cur_year+1) ? " selected='selected'" : "") . ">".($cur_year+1)."</option>\n";
echo "<option value=\"".($cur_year+2)."\"" . ($anno == ($cur_year+2) ? " selected='selected'" : "") . ">".($cur_year+2)."</option>\n";
echo "<option value=\"".($cur_year+3)."\"" . ($anno == ($cur_year+3) ? " selected='selected'" : "") . ">".($cur_year+3)."</option>\n";
echo "<option value=\"".($cur_year+4)."\"" . ($anno == ($cur_year+4) ? " selected='selected'" : "") . ">".($cur_year+4)."</option>\n";
echo "<option value=\"".($cur_year+5)."\"" . ($anno == ($cur_year+5) ? " selected='selected'" : "") . ">".($cur_year+5)."</option>\n";
echo "</select>\n";
?>
</td>
</tr>
<tr>
<td>Permanenza (*)</td>
<td>
<?php
echo "<select name=\"permanenza\">\n";
echo "<option value=\"\">GG</option>\n";
for($b=1;$b <= 30;$b++) {
    echo "<option value=\"".$b."\"" . ($permanenza == $b ? " selected='selected'" : "") . ">".$b."</option>\n";
}
echo "</select>\n";
?>
Giorni
<!-- <input type="text" name="permanenza" value="<?php echo $permanenza; ?>" size="45" /> -->
</td>
</tr>
<tr>
<td>
Camera (*)
</td>
<td>
<?php
$a1 = "";
$a2 = "";
$a3 = "";
$a4 = "";
$a5 = "";
if (is_array($camera)) {
$a1 = (in_array('Singola', $camera) ? "checked=\"checked\"" : "");
$a2 = (in_array('Matrimoniale', $camera) ? "checked=\"checked\"" : "");
$a3 = (in_array('Colazione', $camera) ? "checked=\"checked\"" : "");
$a4 = (in_array('Mezza_Pensione', $camera) ? "checked=\"checked\"" : "");
$a5 = (in_array('Pensione_completa', $camera) ? "checked=\"checked\"" : "");
}
?>
<label><input name="camera[]" value="Singola" type="checkbox" <?php echo $a1; ?> />Camera singola</label><br />
<label><input name="camera[]" value="Matrimoniale" type="checkbox" <?php echo $a2; ?> />Camera matrimoniale</label><br />
<label><input name="camera[]" value="Colazione" type="checkbox" <?php echo $a3; ?> />Camera e colazione</label><br />
<label><input name="camera[]" value="Mezza_Pensione" type="checkbox" <?php echo $a4; ?> />Mezza pensione</label><br />
<label><input name="camera[]" value="Pensione_completa" type="checkbox" <?php echo $a5; ?> />Pensione completa</label>
</td>
</tr>
<tr>
<td>Mezzo di arrivo</td>
<td>
<label><input type="radio" name="mezzo" value="treno" <?php echo ($mezzo == 'treno' ? "checked='checked'" : "" ) ?> />Treno</label><br />
<label><input type="radio" name="mezzo" value="bus" <?php echo ($mezzo == 'bus' ? "checked='checked'" : "" ) ?> />Autobus</label><br />
<label><input type="radio" name="mezzo" value="auto" <?php echo ($mezzo == 'auto' ? "checked='checked'" : "" ) ?> />Auto</label><br />
<label><input type="radio" name="mezzo" value="barca" <?php echo ($mezzo == 'barca' ? "checked='checked'" : "" ) ?> />Barca</label>
</td>
</tr>
<tr>
<td>Comunicazioni (*)</td>
<td><textarea name="messaggio" rows="5" cols="35"><?php echo $messaggio; ?></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
<input type="reset" value="resettare" />&nbsp;
<input type="submit" value="Invia" />
</td>
</tr>
</table> 
</form>
</body>
</html>    