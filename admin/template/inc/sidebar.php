
<?php

$stmt = $cat->showAll();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
            extract($row);
                            
            $category_name= $row['category_name'];

?>
<li><a href="blog.php?cat=<?=$category_name?>">
        <?=$category_name?>
    </a>
</li>
<?php
            }
?>
