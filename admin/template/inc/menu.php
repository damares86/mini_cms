<ul>
    <?php
    $menu=$page->showMenu();
    while ($row = $menu->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
        $str=$row['pagename'];
        $str = preg_replace('/\s+/', '_', $str);
        $str = strtolower($str);
    ?>
        <li><a href="<?=$str?>.php" ><?php
        if($row['pagename']=='index'){
            echo "Home";
        } else {
        echo $row['pagename'];
        }?></a></li>
    <?php
    }
    ?>
</ul>