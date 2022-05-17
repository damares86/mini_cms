
<?php
require "admin/template/inc/header.php";


// if(!is_file('admin/class/Database.php')){
// 	require "admin/inc/dbdata.php";

// }

// session_start();


// if (isset($_SESSION['loggedin'])) {
	// 	header('Location: admin/');
	// 	exit;
	// }
	?>

<div id="bottomContainer">
	<div id="content">
		<div class="d-flex justify-content-center ">
				<div class="card mt-3 mb-5 login">
					<div class="card-body">
						<?php
							require "admin/template/inc/alert.php";
							$op=filter_input(INPUT_GET,"op");
							
							$stmt=$verify->showAll();
								$row=$stmt->fetch(PDO::FETCH_ASSOC);
								$active=$row['active'];
								
								$auth="auth";
								$pass="mngPass";
								if($active==1){
									$auth="authRecap";
									$pass="mngPassRecap";
								}
								
								if($op==""){

						?>

							<h3 class="my-3">Login</h3>

							<form method="POST" class="my-login-validation" novalidate="" action="admin/core/<?=$auth?>.php">
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
										<a href="?op=insert" class="float-right">
											<?=$log_forgot?>
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									<div class="invalid-feedback">
										<?=$log_required?>
									</div>
								</div>
								<input type="hidden" name="recaptcha_response" id="recaptchaResponse">

								<br>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
							</form>

						<?php
							} else if($op=="insert"){
						?>

							<a href="login.php"><-- <?=$log_back?></a>

							<h3 class="my-3"><?=$log_forgot_title?></h3>

							<p><?=$log_forgot_desc?></p>

							<form method="POST" class="my-login-validation" novalidate="" action="admin/core/<?=$pass?>.php">
								<input type="hidden" name="resetForm" value="resetForm" />
								<input type="hidden" name="lang" value="<?=$lang?>" />

								<div class="form-group">
									<label for="email">Email</label>
									<input id="email" class="form-control" name="email" value="" required autofocus>
								</div>


								
								<br>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										<?=$txt_submit?>
									</button>
								</div>
							</form>

							<?php
								} else if($op=="reset"){
								$email=filter_input(INPUT_GET, "email");
								$user->email=$email;
								$token=filter_input(INPUT_GET, "token");
								$user->token=$token;
								$curDate=date("Y-m-d H:i:s");
								$query="SELECT * FROM `password_reset_temp` WHERE `token` = '$token' LIMIT 0,1";
								$stmt=$db->prepare($query);	
								$stmt->execute();
								$row=$stmt->fetch(PDO::FETCH_ASSOC);
								if(!$row['token']){	
							?>


							
								<a href="login.php"><-- <?=$log_back?></a>				


							<?php	
						}else{
							$user->showEmailPass();
							$expDate=$user->expDate;
							if($expDate>=$curDate){
						?>	

							<h3 class="my-3"><?=$log_forgot_new?></h3>
							<form method="POST" class="my-login-validation" novalidate="" action="admin/core/<?=$pass?>.php">
								<input type="hidden" name="resetMail" value="resetMail" />
								<input type="hidden" name="email" value="<?=$email?>" />

								
								<div class="form-group">
									<label for="password">Password
										
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									<div class="invalid-feedback">
										<?=$log_required?>
									</div>
								</div>
								<br>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										<?=$txt_submit?>
									</button>
								</div>
							</form>

						<?php
							} else {
						?>

							<div class="alert alert-danger">
								<?=$log_forgot_exp?>
							</div>
							<a href="login.php"><-- <?=$log_back?></a>

						<?php
							}
						}
						$query="DELETE FROM `password_reset_temp` WHERE email = '.$email.'";
						$stmt=$db->prepare($query);	
						$stmt->execute();
					} 
					?>









				</div>
			</div>
		</div>

</div>
					

						</div> 		
	<script src="admin/scripts/my-login.js"></script>

						<?php
require "admin/template/inc/footer.php";
?>