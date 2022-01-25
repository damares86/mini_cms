
   <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active">
                                    <a href="index.php"><i class="menu-icon icon-dashboard"></i>Dashboard</a>
                                </li>
                            </ul>
                            <ul class="widget widget-menu unstyled">
                                <li>
                                    <a href="index.php?man=users&op=edit&idToMod=1"><i class="menu-icon icon-user"></i>Profile</a>
                                </li>
                                <?php
                                if($_SESSION['rolename']=="Admin"){
                                ?>
                                <li>
                                    <a href="index.php?man=users&op=show"><i class="menu-icon icon-group"></i>Users</a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <ul class="widget widget-menu unstyled">

                                <li>
                                    <a href="index.php?man=post&op=show"><i class="menu-icon icon-edit"></i>Posts</a>
                                </li>
                                <li>
                                    <a href="#"><i class="menu-icon icon-tags"></i>Categories</a>
                                </li>
                            </ul>
                            <ul class="widget widget-menu unstyled">

                            <?php
                            if($_SESSION['rolename']!="Contributor"){
                            ?>
                                <li>
                                    <a href="#"><i class="menu-icon icon-copy"></i>Pages</a>
                                </li>
                            <?php
                            }
                            ?>
                                <li>
                                    <a href="index.php?man=files"><i class="menu-icon icon-folder-open"></i>Files</a>
                                </li>
                            </ul>
                            <?php
                            if($_SESSION['rolename']!="Contributor"){
                            ?>
                            <ul class="widget widget-menu unstyled">
                                <li>
                                    <a href="index.php?man=settings"><i class="menu-icon icon-wrench"></i>Settings</a>
                                </li>
                            </ul>
                            <?php
                            }
                            ?>
                            <!--/.widget-nav-->
                            
                            
                        </div>
                        <!--/.sidebar-->
                    </div>
                   