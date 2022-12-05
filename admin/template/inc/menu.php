<ul>
    <?php
    $page_order=[];
    $link="";
    $link_child="";

    $stmt=$menu->showAllParent();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $class="";
        $name=$row['pagename'];
        $str=$row['pagename'];
        $str = preg_replace('/\s+/', '_', $str);
        $str = strtolower($str);
        $page_order[]=$str;
        $link=$root.$str.".php";
        if($one){
            $link="#$str";
        }
        ?>
        <li><a href="<?=$link?>" class="scrolly"><?php
        if($name=='index'){
            echo "Home";
        } else if($name=="Post"||$name=="Blog"){
            echo "Blog";
        }else{
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
                        
                        if($name=="Post"||$name=="Blog"){
                            $str1="blog";
                        }
                        $str1 = preg_replace('/\s+/', '_', $str1);
                        $str1 = strtolower($str1);
                        $page_order[]=$str1;
                        $link_child=$root.$str1.".php";
                        if($one){
                            $link_child="#$str1";
                        }
                        ?>
                            <li style="white-space: nowrap;"><a href="<?=$link_child?>" style="display: block;" class="scrolly"><?php
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
    ?>

</ul>