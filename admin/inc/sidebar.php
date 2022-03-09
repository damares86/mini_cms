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
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=users&op=edit&idToMod=<?=$user_id?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profile</span></a>
            </li>
            <?php
            //if($_SESSION['rolename']=="Admin"){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?man=users&op=show">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span></a>
            </li>
            <?php
            //}
            ?>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Managing site
            </div>

            <?php
            if($_SESSION['rolename']!="Contributor"){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?man=page&op=show">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Pages</span></a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?man=files&op=show">
                    <i class="fas fa-fw fa-folder-open"></i>
                    <span>Files</span></a>
            </li>


            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Blog
            </div>

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=post&op=show">
                    <i class="fas fa-fw fa-marker"></i>
                    <span>Posts</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=cat&op=show">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Categories</span></a>
            </li>
            <?php
            if($_SESSION['rolename']!="Contributor"){
            ?>
             <!-- Heading -->
             <div class="sidebar-heading">
                Settings
            </div>

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=settings">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Site settings</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?man=color&op=show">
                    <i class="fas fa-fw fa-image"></i>
                    <span>Theme settings</span></a>
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