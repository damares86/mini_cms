<?php

include("../../class/Database.php");
include("../../class/Settings.php");

$database = new Database();
$db = $database->getConnection();
$settings = new Settings ($db);

$stmt =$settings->showSettings();



if($dm==0){
    ?>
</head>

<body>
    <div id="siteContainer">
        <div id="bottomContainer" class="mt-5 p-5">  
            <h1 style="text-align:center; font-size:3em;">Site under maintenance</h1>
            <br><br>
            <h1 style="text-align:center; font-size:3em;">Sito in manutenzione</h1>
        </div>
    </div>
</body>
</html>


    <?php
    exit;
}


?>