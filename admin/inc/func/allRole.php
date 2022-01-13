<?php
$sql = $conn->prepare("SELECT * FROM roles $where");
$sql->execute();

$resultAll = $sql->get_result();

$totalRecords = $resultAll->num_rows;

$recordPagina = 10;

$totalPages = ceil($totalRecords / $recordPagina);

$currentPage = 1;

if (isset($_GET["page"])) {
    $currentPage = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
}

$offset = ($currentPage - 1) * $recordPagina;


$ascDesc = "DESC";
if (isset($_GET["ascDesc"])) {
    $ascDesc = filter_input(INPUT_GET, "ascDesc");
}

$orderBy = "";

if (isset($_GET["orderBy"])) {
    $orderBy = "ORDER BY " . filter_input(INPUT_GET, "orderBy") . " " . $ascDesc;
    if ($ascDesc == "ASC") {
        $ascDesc = "DESC";
    } else {
        $ascDesc = "ASC";
    }
}

$query = "SELECT * FROM roles $where $orderBy LIMIT $offset,$recordPagina";

$sql = $conn->prepare($query);
$sql->execute();
$result = $sql->get_result();

if ($search) {
    $search = "&s=$search";
}
?>
<div class="module">
    <div class="module-body">

        <div class="align-items-center pt-3 pb-2 mb-3 align-items-center">
            <!-- <h6><a href="home.php"><-- Back to dashboard's home</h6></a> -->
            <h1 class="h2 mx-auto text-center">Roles</h1>
            <a href="index.php?man=roles&op=add"><button type="button" class="btn btn-success">Add new role +</button></a>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Role's name</th>
                    <!-- <th scope="col"><a href="?op=modUser&orderBy=email&ascDesc=<?= $ascDesc . $search ?>" class="dark">Email</a></th> -->
                    <!-- <th scope="col"><a href="?op=modUser&orderBy=email&ascDesc=<?= $ascDesc . $search ?>" class="dark">Role</a></th> -->
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($result as $row){
                ?>
                    <tr>
                        <th scope="row"><?= $row["id"] ?></th>
                    
                        <td><?= $row["rolename"] ?></td>
                        <td><a href="index.php?man=roles&op=edit&idToMod=<?=$row["id"] ?>"><button type="button" class="btn btn-primary">Edit</button></a></td>
                        <td><a href="core/mngRole.php?idToDel=<?=$row["id"] ?>"><button type="button" class="btn btn-danger">Delete</button></a></td>
                    </tr>
                <?php
                }
                ?>


            </tbody>
        </table>


    </div>
</div>
