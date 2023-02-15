<?php

require 'vendor/autoload.php';		// If installed via composer
$debug = new \bdk\Debug(array(
	'collect' => true,
	'output' => true,
));

session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}

// version number of Mini Cms
require "inc/version.php";

// loading class
spl_autoload_register('autoloader');

function autoloader($class){
	include("class/$class.php");
}

// check if there's a prefix set by the user for the db tables 
$prefix_table="";
if(is_file("core/prefix.php")){
  include "core/prefix.php";
  $prefix_table=$prefix;
}

// connection to the db
$database = new Database();
$db = $database->getConnection();

// recall of all the classes
$files=glob("class/*.php", GLOB_BRACE);
rsort($files); 

// creation of the file with all the initialization of the classes
if(!is_file('inc/class_initialize.php')){
$file_handle = fopen('inc/class_initialize.php', 'w');
fwrite($file_handle, '<?php');
fwrite($file_handle, "\n");
foreach ($files as $filename) {
    $nomefile = pathinfo($filename);
    $file=$nomefile['filename'];
    $file_var = strtolower($file);
    fwrite($file_handle, '$'.$file_var.' = new '.$file.'($db);');
    fwrite($file_handle, "\n");
    fwrite($file_handle, '$'.$file_var.'->prx = "'.$prefix_table.'";');
    fwrite($file_handle, "\n");
}
fwrite($file_handle,"?>");
chmod('inc/class_initialize.php',0777);

}

// inclusion of the file that initialize all the classes
include "inc/class_initialize.php";

// count of users
$total_user=$user->countAll();
$total_pages=$page->countAllCustom();

// setting dashboard language
$stmt=$settings->showLangAndName();
$lang=$settings->dashboard_language;

foreach (glob("locale/$lang/*.php") as $row){
    require "$row";
}


?>
<!DOCTYPE html>
<html lang="<?=$lang?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Dm WebLab">
    <link rel="icon" href="assets/img/favicon.ico" type="image/png"/>

        <!--            
          ##############    Mini Cms    ##############
          #                                          #
          #           A project by DM WebLab         #
          #   Website: https://www.dmweblab.com      #
          #   GitHub: https://github.com/damares86   #
          #                                          #
          ############################################
        -->

    <title>Dashboard "<?=$settings->site_name?>"</title>

    
    <script type="text/javascript" src="scripts/farbtastic/farbtastic.js"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>    
    <script src="scripts/select.js"></script>
    <script src="scripts/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
    <link rel="stylesheet" href="scripts/farbtastic/farbtastic.css" type="text/css" />
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/select.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

            <?php
        $counter="1";
if(filter_input(INPUT_GET,"count")){
    $counter=filter_input(INPUT_GET,"count");
}
$_SESSION['counter']=$counter;
?>
<!-- image uploader for tinymce -->
<script>
const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
  const xhr = new XMLHttpRequest();
  xhr.withCredentials = false;
  xhr.open('POST', '../uploads/postAcceptor.php');

  xhr.upload.onprogress = (e) => {
    progress(e.loaded / e.total * 100);
  };

  xhr.onload = () => {
    if (xhr.status === 403) {
      reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
      return;
    }

    if (xhr.status < 200 || xhr.status >= 300) {
      reject('HTTP Error: ' + xhr.status);
      return;
    }

    const json = JSON.parse(xhr.responseText);

    if (!json || typeof json.location != 'string') {
      reject('Invalid JSON: ' + xhr.responseText);
      return;
    }

    resolve(json.location);
  };

  xhr.onerror = () => {
    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
  };

  const formData = new FormData();
  formData.append('file', blobInfo.blob(), blobInfo.filename());

  xhr.send(formData);
});
</script>

<!-- tinimce -->
<script>
<?php

for($i=1;$i<=$counter;$i++){
  ?>
tinymce.init({
  selector: 'textarea#editor<?=$i?>',
  images_upload_handler: example_image_upload_handler,
  plugins: 'link image code lists',
  toolbar: 'undo redo | blocks | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | link image | bullist numlist outdent indent | ' +
  'removeformat | code',

});

<?php
}

?>

</script>

</head>
