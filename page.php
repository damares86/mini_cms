<?php


// require 'admin/phpDebug/src/Debug/Debug.php';   			// if not using composer

// $debug = new \bdk\Debug(array(
//     'collect' => true,
//     'output' => true,
// ));


// session_start();
// if (!isset($_SESSION['loggedin'])) {
//     header('Location: ../');
//     exit;
// }

// loading class

spl_autoload_register('autoloader');

function autoloader($class){
	include("admin/class/$class.php");
}

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);


$stmt = $post->showAll($from_record_num, $records_per_page);

$total_rows=$post->countAll();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
                 extract($row);
                 
                 echo "<strong><i>" . $title . "</i></strong>";
                 echo $content;
                 echo "Modificato: " . $modified;
                 echo "<hr><br>";
                 


            }
       
            ?>



