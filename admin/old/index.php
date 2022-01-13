	<?php
	// We need to use sessions, so you should always start sessions using the below code.
	session_start();
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) {
		header('Location: ../index.php');
		exit;
	}

	


	require "core/functions.php";
	//require "core/array.php";
	$conn = OpenConnection();
	

	$user=$_SESSION['name'];

	if($user=="admin"){
		header("Location: admin/");
	} else {
	?>
<?php

require "inc/header.php";


$manage=filter_input(INPUT_GET,"man");
$operation=filter_input(INPUT_GET,"op");

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
                            
                            $userID=$_SESSION['id'];

                            $userData=GetDataById($conn, "accounts", $userID);
                            $roleID=$userData["role_id"];
                            $role=GetDataById($conn, "roles", $roleID);
                            $rolename=$role['rolename'];

                            if($manage=="file"){
                                    require "inc/file.php";
                            } else if($manage=="edit"){
                                    require "inc/edProfile.php";
                            } else {
                                
                                    require "inc/profile.php";
                                
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
<?php
}
?>