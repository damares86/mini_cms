
<?php
require "admin/template/inc/header.php";



	?>

<div id="bottomContainer">
	<div id="content">
		<div class="d-flex justify-content-center ">
				<div class="card mt-3 mb-5 login">
					<div class="card-body">
						<?php
							require "admin/template/inc/alert.php";


								$stmt=$verify->showAll();
								$row=$stmt->fetch(PDO::FETCH_ASSOC);
								$active=$row['active'];

								$send="mngMail";
								if($active==1){
									$send="mngMailRecap";
								}


						?>

							<h3 class="my-3"><?=$cont_form_title?></h3>

							<form method="POST" class="my-login-validation" novalidate="" action="admin/core/<?=$send?>.php">
								<div class="form-group">
									<label for="name"><?=$cont_form_name?></label>
									<input id="name" class="form-control" name="name" value="" required autofocus>
								</div>
								<div class="form-group">
									<label for="email"><?=$cont_form_email?></label>
									<input id="email" class="form-control" name="email" value="" required autofocus>
								</div>

								<div class="form-group">
									<label for="contact"><?=$cont_form_select_email?></label>
									<select name="contact">
									<?php
										$stmt1=$contact->showAllContacts();
										while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
											extract($row1);
										
											echo "<option value='".$row1['email']."'>".$row1['label']."</option>";

										
									}
										?>
									</select>
								</div>

								<div class="form-group">
									<label for="subject"><?=$cont_form_sub?></label>
									<input id="subject" class="form-control" name="subject" value="" required autofocus>

								</div>
								<div class="form-group">
									<label for="message"><?=$cont_form_msg?></label>
									<textarea id="message" name="message" placeholder="Write your message here"></textarea>
								</div>
								
								<input type="hidden" name="recaptcha_response" id="recaptchaResponse">

								<br>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										<?=$cont_form_button?>
									</button>
								</div>
							</form>

				</div>
			</div>
		</div>

</div>
					

						</div> 			
						<?php
require "admin/template/inc/footer.php";
?>