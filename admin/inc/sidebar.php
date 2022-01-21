<?php
if($_SESSION['user_id']==1){
?>
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
                                <li>
                                    <a href="index.php?man=users&op=show"><i class="menu-icon icon-group"></i>Users</a>
                                </li>
                            </ul>
                            <ul class="widget widget-menu unstyled">

                                <li>
                                    <a href="index.php?man=post&op=show"><i class="menu-icon icon-edit"></i>Posts</a>
                                </li>
                                <li>
                                    <a href="index.php?man=post&op=show"><i class="menu-icon icon-copy"></i>Pages</a>
                                </li>
                                <li>
                                    <a href="index.php?man=files&op=show"><i class="menu-icon icon-folder-open"></i>Files</a>
                                </li>
                            </ul>
                            <ul class="widget widget-menu unstyled">
                                <li>
                                    <a href="index.php?man=post&op=show"><i class="menu-icon icon-wrench"></i>Settings</a>
                                </li>
                            </ul>
                            <!--/.widget-nav-->
                            
                            
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <?php
                    } else{
                        ?>
                         <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active">
                                    <a href="index.php"><i class="menu-icon icon-dashboard"></i>utente</a>
                                </li>
                            </ul>
                            <!--/.widget-nav-->
                            
                            
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <?php
                    }
                    ?>