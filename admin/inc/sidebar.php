<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../">
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

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=users&op=edit&idToMod=<?=$user_id?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span><?=$side_profile?></span></a>
            </li>
            <?php
            //if($_SESSION['rolename']=="Admin"){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?man=users&op=show">
                    <i class="fas fa-fw fa-users"></i>
                    <span><?=$side_users?></span></a>
            </li>
            <?php
            //}
            ?>


            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                <?=$side_manage?>
            </div>

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
                        <a class="collapse-item" href="index.php?man=page&op=show&type=default"><?=$side_page_default?></a>
                        <a class="collapse-item" href="index.php?man=page&op=show&type=custom"><?=$side_page_custom ?></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-image"></i>
                    <span><?=$side_port?></span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?man=portfolio&op=show"><?=$side_project?></a>
                        <a class="collapse-item" href="index.php?man=catPortfolio&op=show"><?=$side_project_cat?></a>
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
                
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
               
           
            
            <?php
            if($_SESSION['rolename']!="Contributor"){
            ?>
             <!-- Heading -->
             <div class="sidebar-heading">
             <?=$side_settings?>
            </div>

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=settings">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span><?=$side_siteset?></span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=menu">
                    <i class="fas fa-fw fa-bars"></i>
                    <span><?=$side_menuset?></span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=color&op=show">
                    <i class="fas fa-fw fa-palette"></i>
                    <span><?=$side_themeset?></span></a>
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