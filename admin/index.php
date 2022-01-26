<?php

require "inc/header.php";



$manage=filter_input(INPUT_GET,"man");
$operation=filter_input(INPUT_GET,"op");


// $usersCount=GetAllRows($conn,"accounts");
// $filesCount=GetAllRows($conn,"files");

$user=$_SESSION['name'];



?>

    <body>
        <?php

        require "inc/navbar.php";

        ?>

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php
                        require "inc/sidebar.php";
                    ?>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                        <?php
                            

                            if($manage=="post"){
                                if($operation=="show"){
                                    require "inc/func/allPost.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regPost.php";
                                } 
                            } else if($manage=="users"){
                                if($operation=="show"){
                                    require "inc/func/allUser.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regUser.php";
                                }
                            // } else if($manage=="roles"){
                            //     if($operation=="show"){
                            //         require "inc/func/allRole.php";
                            //     } else if($operation=="add"||$operation=="edit"){
                            //         require "inc/func/regRole.php";
                            //     } 
                            } else if($manage=="files"){
                                 require "inc/func/allFile.php";
                            }else if($manage=="settings"){
                                require "inc/func/allSettings.php";
                            }else if($manage=="cat"){
                                if($operation=="show"){
                                    require "inc/func/allCat.php";
                                } else if($operation=="add"||$operation=="edit"){
                                    require "inc/func/regCat.php";
                                }
                            }else if($manage=="color"){
                                if($operation=="show"){
                                    require "inc/func/allColor.php";
                                } else if($operation=="add"){
                                    require "inc/func/regColor.php";
                                }
                            }else{  
                        ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>damares86 Admin Dashboard</h3>
                                    
                                </div>
                                <div class="module-body">
                                <?php
                                require "inc/alert.php";
                                ?>
                                    <section class="docs">
                                        <p>Welcome <b><?=$user?></b> to you Admin Dashboard Area.</p>
                                        <p>Below you have some quick links to manage the reserved area.</p><br>
                                        <p>Here there are two buttons to change your username and password:<br><br>
                                        <a href="index.php?man=admin&type=name" class="btn btn-primary">Change Username</a> 
                                        <a href="index.php?man=admin&type=psw" class="btn btn-primary">Change Password</a>
                                        </p>
                                    </section>
                                </div>
                            </div>

                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="index.php?man=users&op=show" class="btn-box big span6"><i class="icon-user"></i><b><?= $usersCount ?></b>
                                        <p class="text-muted">
                                            Users</p>
                                    </a><a href="index.php?man=files&op=show" class="btn-box big span6"><i class=" icon-folder-open"></i><b><?= $filesCount ?></b>
                                        <p class="text-muted">
                                           Files</p>
                                    </a>
                                </div>
                                <div class="module">
                                    <div class="module-head">
                                        <h3>Quick links</h3>
                                        
                                    </div>
                                </div>
                                <div class="btn-box-row row-fluid">
                                    <a href="index.php?man=users&op=add" class="btn-box small span3">
                                        <i class="icon-plus"></i><b>Add User</b>
                                    </a>
                                    <a href="index.php?man=users&op=show" class="btn-box small span3">
                                        <i class="icon-group"></i><b>Manage Users</b>
                                    </a>
                                    <a href="index.php?man=roles&op=show" class="btn-box small span3">
                                        <i class="icon-key"></i><b>Manage Roles</b>
                                    </a>
                                    <a href="index.php?man=files&op=show" class="btn-box small span3">
                                        <i class="icon-folder-open"></i><b>Manage Files</b>
                                    </a>                                           
                                </div>
                                   
                            </div>
                            <!--/.module-->
                            <?php 
                            }
                            ?>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
            <!-- <div class="footer">
                <div class="container">
                    <b class="copyright">&copy; 2014 Edmin - EGrappler.com </b>All rights reserved.
                </div>
            </div> -->
        <?php
        require "inc/footer.php";
        ?>
      
    </body>
</html>