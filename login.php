<?php


if(!is_file('admin/class/Database.php')){
	require "admin/inc/dbdata.php";

}

// require "admin/core/functions.php";
// $conn = OpenConnection();

session_start();


// if (isset($_SESSION['loggedin'])) {
//     header('Location: admin/');
//     exit;
// }


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="damares86">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>damares86 reserved area</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="login/css/my-login.css">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="login/img/logodm.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation" novalidate="" action="admin/core/auth.php">
								<!-- <div class="form-group">
									<label for="username">Username</label>
									<input id="username" class="form-control" name="username" value="" required autofocus>
								</div> -->
								<div class="form-group">
									<label for="email">Email</label>
									<input id="email" class="form-control" name="email" value="" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Password
										<!-- <a href="forgot.html" class="float-right">
											Forgot Password?
										</a> -->
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>
								
								<br>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
							</form>
						</div>
					
					</div>
					<div class="footer">
						Created by &copy; <a href="https://github.com/damares86">damares86</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="login/js/my-login.js"></script>
</body>
</html>
<?php
								// }
							?> 
