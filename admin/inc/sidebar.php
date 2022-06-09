<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center shadow bg-white" href="../">
                <div class="logo">
                    <img src="assets/img/logo.svg">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span><?=$side_dash?></span>
                </a>
            </li>
            <?php
            if($_SESSION['rolename']!="Contributor"){
            ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseZero"
                    aria-expanded="true" aria-controls="collapseZero">
                    <i class="fas fa-fw fa-users"></i>
                    <span><?=$side_users?></span>
                </a>
                <div id="collapseZero" class="collapse" aria-labelledby="headingZero" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?man=users&op=edit&idToMod=<?=$user_id?>"><?=$side_profile?></a>
                        <a class="collapse-item" href="index.php?man=users&op=show"><?=$side_users ?></a>
                    </div>
                </div>
            </li>
            <?php
            }
            ?>



            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading"><?=$side_manage?></div>
            <?php
            if($_SESSION['rolename']!="Contributor"){
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-file"></i>
                    <span><?=$side_page?></span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?man=page&op=show&type=custom"><?=$side_page_custom ?></a>
                        <a class="collapse-item" href="index.php?man=page&op=show&type=default"><?=$side_page_default?></a>
                    </div>
                </div>
            </li>
            
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-marker"></i>
                    <span><?=$side_blog?></span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?man=post&op=show"><?=$side_post?></a>
                        <a class="collapse-item" href="index.php?man=cat&op=show"><?=$side_cat?></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseFour">
                    <i class="fas fa-fw fa-images"></i>
                    <span><?=$side_gall?></span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?man=gall&op=show"><?=$side_gall_all?></a>
                        <a class="collapse-item" href="index.php?man=gall&op=add"><?=$side_gall_upload?></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?man=files&op=show">
                    <i class="fas fa-fw fa-folder-open"></i>
                    <span><?=$side_files?></span></a>
                </li>
                <?php
            if($_SESSION['rolename']!="Contributor"){
            ?>
                

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading"><?=$side_plugin?></div>

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=plugins&op=show">
                    <i class="fas fa-puzzle-piece"></i>
                    <span><?=$side_manage_plugins?></span>
                </a>
            </li>
            <?php
            $stmt2=$plugins->showAll();
            $counter=1;
            foreach($stmt2 as $row){
                $title=$row['title'];
                $show_title=$row['sub_show_title'];
                $add_title=$row['sub_add_title'];
                if($row['active']==1){
               
            ?>
            <li class="nav-item">
            <?php
                if(!is_null($row['sub_show_title'])){
                ?>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?=$counter?>"
                    aria-expanded="true" aria-controls="collapse<?=$counter?>">
                    <i class="<?=$row['icon']?>"></i>
                    <span>
                        <?php
                        echo $$title;
                        ?>
                    </span>
                </a>
            
                <div id="collapse<?=$counter?>" class="collapse" aria-labelledby="heading<?=$counter?>" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?=$row['sub_show_link']?>"><?=$$show_title?></a>
                        <?php
                        if(!is_null($row['sub_add_title'])){
                            ?>
                        <a class="collapse-item" href="<?=$row['sub_add_link']?>"><?=$$add_title?></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }else{
                ?>
                 <a class="nav-link" href="<?=$row['link']?>">
                    <i class="<?=$row['icon']?>"></i>
                    <span>
                        <?php
                        echo $$title;
                        ?>
                    </span>
                </a>
            </li>
            
            <?php
                }
            }
            $counter++;
        }
            }
            ?>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
               
           
            
            <?php
            if($_SESSION['rolename']!="Contributor"){
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                    aria-expanded="true" aria-controls="collapseFive">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span><?=$side_settings?></span>
                </a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?man=settings"><?=$side_siteset?></a>
                        <a class="collapse-item" href="index.php?man=menu"><?=$side_menuset?></a>
                        <a class="collapse-item" href="index.php?man=color&op=show"><?=$side_themeset?></a>
                    </div>
                </div>
            </li>
           

            <?php
            }
            ?>
         
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

           

        </ul>
        <!-- End of Sidebar -->