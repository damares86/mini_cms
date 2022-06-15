<?php


$stmt =$settings->showSettings();
require "admin/core/site.php";


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

if($site!=$_SERVER['SERVER_NAME']){
    ?>
    </head>
    
    <body>
        <div id="siteContainer">
            <div id="bottomContainer" class="mt-5 p-5">  
                <h1 style="text-align:center; font-size:3em;">Licenza non valida</h1>
                <br><br>
                <h1 style="text-align:center; font-size:3em;">Invalid license</h1>
            </div>
        </div>
    </body>
    </html>
    
    
        <?php
        exit;
}

?>