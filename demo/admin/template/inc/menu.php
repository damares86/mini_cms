<ul>
    <?php
    $stmt=$menu->showAllParent();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        // $name=$pagename;
        $class="";
        $name=$row['pagename'];
        $str=$row['pagename'];
        $str = preg_replace('/\s+/', '_', $str);
        $str = strtolower($str);
        ?>
        <li><a href="<?=$str?>.php" ><?php
        if($name=='index'){
            echo "Home";
        } else {
        echo $name;
        }?></a>
        <?php
                
                $menu->childof=$name;
                $num=$menu->countChildInMenu();
                if($num>0){
                $stmt1=$menu->showAllChildInMenu();
                ?>
                <ul>
                <?php
                  while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
                        
                        extract($row1);
                        
                        $str1=$row1['pagename'];
                        $str1 = preg_replace('/\s+/', '_', $str1);
                        $str1 = strtolower($str1);
                        ?>
                            <li style="white-space: nowrap;"><a href="<?=$str1?>.php" style="display: block;"><?php
                                if($row1['pagename']=='index'){
                                    echo "Home";
                                } else {
                                echo $row1['pagename'];
                                }?></a>
                            </li>
                            <?php
                    }
                    
                    ?>
                    </ul>
                    <?php
                }
                ?>
        </li>
        <?php
        }
    // }
    ?>

</ul>