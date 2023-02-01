<?php

$file = basename($_SERVER['PHP_SELF']);
$page_class = pathinfo($file, PATHINFO_FILENAME);

$page->page_name=$page_class;

$json_file = 'admin/inc/pages/contact.json';
$data = file_get_contents($json_file);
$json_arr = json_decode($data, true);

?>
<div id="contact">
<div class="row">
        <div class="col-12 col-xl-6">
            <div class="row address">
                <div class="col-12">
                    <?php
                        echo $json_arr[1]['block1'];
                    ?>
                </div>
                <div class="col-12 maps">
                    <?php
                        echo $json_arr[2]['block2'];
                    ?>     
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
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