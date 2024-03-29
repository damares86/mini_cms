
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="DM WebLab">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Mini Cms by DM WebLab</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="admin/assets/css/my-login.css">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand justify-content-center">
						<img src="admin/assets/img/logo.svg" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							
							<h4 class="card-title">Insert your database data</h4>
							<form method="POST" class="my-login-validation" novalidate="" action="admin/core/configdb.php">
								<div class="form-group">
									<label for="host">Server host (es. localhost) <span class="text-danger font-weight-bold">*</span></label>
									<input id="host" class="form-control" name="host" value="" required autofocus>
									<div class="invalid-feedback">
										Server host is required
							    	</div>
								</div>

								<div class="form-group">
									<label for="dbname">Database name <span class="text-danger font-weight-bold">*</span></label>
									<input id="dbname" class="form-control" name="dbname" value="" required autofocus>
									<div class="invalid-feedback">
										Database name is required
							    	</div>
								</div>

								<div class="form-group">
									<label for="username">Database user <span class="text-danger font-weight-bold">*</span></label>
									<input id="username" class="form-control" name="username" value="" required autofocus>
									<div class="invalid-feedback">
										Database user is required
							    	</div>
								</div>

								<div class="form-group">
									<label for="db_password">Database Password <span class="text-danger font-weight-bold">*</span></label>
									<input id="db_password" type="password" class="form-control" name="db_password" required data-eye>
								    <div class="invalid-feedback">
										Database Password is required
							    	</div>
								</div>
								<hr>

								<div class="form-group">
									<label for="prefix">Table prefix <br>(useful if you have more sites on the same database)</label>
									<input id="prefix" class="form-control" name="prefix" value="" autofocus>
								</div>

								<hr>
								<div class="form-group">
									<label for="email">Your admin email <span class="text-danger font-weight-bold">*</span></label>
									<input id="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
								    	Email is required
							    	</div>
								</div>

								<div class="form-group">
									<label for="password">Your admin Password <span class="text-danger font-weight-bold">*</span></label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>
								
								<br>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Submit
									</button>
								</div>
							</form>
						</div>
					
					</div>
					<div class="footer">
						Created by &copy; <a href="https://www.dmweblab.com">Dm WebLab</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="admin/scripts/my-login.js"></script>
</body>
</html>
