<?php 

require "../core/functions.php";
$conn=OpenConnection();


$idFile=filter_input(INPUT_GET,"idFile");


$file=GetDataById($conn, "files", $idFile);
$filename=$file['filename'];



if(is_file($filename)){
  $file = $filename;
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="'.basename($file).'"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($file));
  readfile($file);
}else{
  header("Location: ../index.php?err=noFile");
}



?>