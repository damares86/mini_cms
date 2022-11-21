                <div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
							<a href="<?=$root?>index.php">
                          		  <img src="<?=$root?>uploads/img/<?=$logo?>">
                       	 </a>
						 <h3><?=$site_name?></h3>
							</div>

						<!-- Nav -->
							<nav id="nav">
                            <?php
                                require "".$root."admin/template/inc/menu.php";
                            ?>
							</nav>
					</header>
				</div>