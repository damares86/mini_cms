<?php
require "admin/template/inc/header.php";

?>
            <div id="bottomContainer">
                <?php

                $page->page_name="index";
                $page_class="index";
                
                $stmt=$page->showByName();
                ?>
                <div id="content">
                    
                
                    <div class="block block1 <?=$page_class?>">

							<form class="form-horizontal" role="form" method="post" action="contactform.php">
								<div class="form-group">
									<label for="name" class="col-sm-2 control-label">Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
										<?php echo "<p class='text-danger'>$errName</p>";?>
                                    </div>
									
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-10">
										<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
										<?php echo "<p class='text-danger'>$errEmail</p>";?>
									</div>
								</div>
								<div class="form-group">
									<label for="message" class="col-sm-2 control-label">Message</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
										<?php echo "<p class='text-danger'>$errMessage</p>";?>
									</div>
								</div>
								<div class="form-group">
									<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
										<?php echo "<p class='text-danger'>$errHuman</p>";?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<?php echo $result; ?>	
									</div>
								</div>
							</form> 
                        <?php
                        // echo $page->block1;
                        ?>            
                    </div>
                    <?php
                    if($page->block2){
                    ?>
                    <div class="block block2 <?=$page_class?>">
                    <?php
                        echo $page->block2;
                        ?>  
                    </div>
                    <?php
                    }
                    if($page->block3){
                    ?>
                    <div class="block block3 <?=$page_class?>">
                    <?php
                        echo $page->block3;
                        ?>  
                    </div>
                    <?php
                    }
                    if($page->block4){
                    ?>
                    <div class="block block4 <?=$page_class?>">
                    <?php
                        echo $page->block4;
                        ?>  
                    </div>
                    <?php
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>

<?php
require "admin/template/inc/footer.php";
?>