<?php

$query = "SELECT * FROM files WHERE role_id=$roleID";

                                $sql = $conn->prepare($query);
                                $sql->execute();
                                $result = $sql->get_result();


                          ?>
                            <div class="module">
                                <div class="module-head">
                                    <h3>User Dashboard</h3>
                                    
                                </div>
                                <div class="module-body">
                                    <p>Here you can find all your file, just click on the button to download them.</p>
                                    <hr>

                                    <table class="table">
                                        <thead>
                                            <th>File Title</th>
                                            <th>File Name</th>
                                            <th>Download</th>
                                        </thead>
                                        <tbody>
                                    <?php
                                        foreach($result as $row){
                                    ?>
                                            <tr>
                                                <td><?=$row['title']?></td>
                                                <td><?=$row['filename']?></td>
                                                <td>  
                                                    <a href="file/download.php?idFile=<?=$row['id']?>">
                                                        <button type="button" class="btn btn-success btn-sm">Download</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>

                                </div>
                               
                            </div>
                            <!--/.module-->