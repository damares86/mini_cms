                <div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
								<a href="<?=$root?>index.php">
							<?php
							if($use_logo==1){
								?>
                          		  <img src="<?=$root?>uploads/img/<?=$logo?>">
									<?php
							}
							?>
						 <h3><?=$site_name?></h3>
						</a>
							</div>

						<!-- Nav -->
							<nav id="nav">
                            <?php
                                require "".$root."admin/template/inc/menu.php";
                            ?>
							</nav>
					</header>
				</div>