<?php
                    $menu->childof=$page;
                    $stmt3=$menu->showAllChild();
                    while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
                        extract($row3);
                        $child=$childof;
                        $order1=$itemorder;
                        $checkedParent="";
                        ?>
                        <tr>
                            
                            <td><?=$childSpace?><?=$pagename?><input type="hidden" name="idChild[]" value="<?= $id ?>" /></td>
                            <td><input type="checkbox" name="parent" value="1" <?=$checkedParent?>></td>
                            <td>
                                <select name="childofChild">
                                    <?php
                                    $stmt4 = $menu->showAllParent();
                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
                                        extract($row4);
                                        $selected = "";
                                        if ($child==$pagename) {
                                            $selected = "selected";
                                        }
                                        echo "<option value='{$id}' $selected>{$pagename}</option>";
                                    }
                                    ?>
                                </select>  
                            </td>
                        <td>
                            <select name="itemorderChild">
                                <?php
                                $stmt2 = $menu->countAll();
                                for ($i=1; $i <= $stmt2 ; $i++) { 
                                    $selected="";
                                    if($i == $order1){
                                        $selected = "selected";
                                    }
                                    echo "<option value='{$i}' $selected>sub-> {$i}</option>";

                                    $selected="";
                                }
                                ?>
                            </select>    
                        </td>
                        <td><input type="checkbox" name="inmenuChild"> Remove</td>
                    </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <br><br>
        <h3><u>Page not in menu</u></h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Page Name</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Child of</th>
                    <th scope="col">Item order</th>
                    <th scope="col">In menu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $menu->showAllNotInMenu();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $order=$itemorder;
                    $order1=$itemorder;
                    $checkedMenu ="";
                    $checkedParent = "checked";
                    $page=$pagename;
                    
                    $childSpace="&nbsp;---&nbsp;";

                    if($inmenu==1){
                        $checkedMenu="checked";
                    }
                ?>
                <tr>
                    <td><?=$pagename?><input type="hidden" name="idNoMenu[]" value="<?= $id ?>" /></td>
                    <td><input type="checkbox" name="parent" value="1" <?=$checkedParent?>></td>
                    <td>
                        -
                    </td>
                    <td>
                        <select name="itemorderNotInMenu">
                            <?php
                            $stmt2 = $menu->countAll();
                            for ($i=1; $i <= $stmt2 ; $i++) {
                                $selected="";
                                if($i == $order){
                                    $selected = "selected";
                                }
                                echo "<option value='{$i}' $selected>{$i}</option>";
                                
                                $selected="";
                            }
                            ?>
                        </select>    
                    </td>
                    <td><input type="checkbox" name="notInMenu"> Add</td>
                </tr>
            <?php   
            }
        ?>