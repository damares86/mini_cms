<?php

/*
    ###################################################################
    #                                                                 #
    #   Reserved Area by damares86 (https://github.com/damares86/)    #
    #                                                                 #
    ###################################################################
*/





function OpenConnection()
{
    require "db.php";
     
    $charset = 'utf8';
    $conn = new mysqli($server, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Errore di connessione al MySQL " . $conn->connect_error);
    }
    $conn->set_charset($charset);
    return $conn;
}

function showQueryResult($result, $messageError, $messageSuccess = "")
{
    if (!$result) {
        echo "<br />";
        die("Errore durante l'esecuzione della query $messageError");
    } else {
        if (!empty($messageSuccess)) {
            echo $messageSuccess . "<br />";
        }
    }
}


// RECUPERO TUTTI I DATI A PARTIRE DALLO USERNAME

function GetDataByUsername($conn,$table,$username)
{
    $sql = $conn->prepare("SELECT * FROM $table WHERE username=?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    $sql->close();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}


// RECUPERO TUTTI I DATI A PARTIRE DALL'ID

function GetDataById($conn, $table, $id)
{
    $sql = $conn->prepare("SELECT * FROM $table WHERE id=?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();

    $sql->close();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// RECUPERO ID DA PERMISSION

function GetUserProducts($conn,$id)
{
    $sql = $conn->prepare("SELECT * FROM permission WHERE id_user=?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();
    showQueryResult($result, $conn->error);

    if ($result->num_rows == 0) {
        return false;
    }

    return $result;
}

// RECUPERO PRODOTTI ACTIVE DA PERMISSION

function GetProductsActive($conn,$idUser,$idProduct)
{
    $sql = $conn->prepare("SELECT * FROM permission WHERE id_user=? AND id_product=? AND active=1");
    $sql->bind_param("ii", $idUser, $idProduct);
    $sql->execute();
    $result = $sql->get_result();
    showQueryResult($result, $conn->error);

    if ($result->num_rows == 0) {
        return false;
    }

    return $result;
}

// RECUPERO PRODOTTI ACTIVE DA PERMISSION

function GetAllPermissionProducts($conn,$idUser,$idProduct)
{
    $sql = $conn->prepare("SELECT * FROM permission WHERE id_user=? AND id_product=?");
    $sql->bind_param("ii", $idUser, $idProduct);
    $sql->execute();
    $result = $sql->get_result();
    showQueryResult($result, $conn->error);

    if ($result->num_rows == 0) {
        return false;
    }

    return $result;
}


// RECUPERO TUTTI I RECORD

function GetAllRecords($conn, $table)
{
    $sqlString = "SELECT * FROM $table";
    $sql = $conn->prepare($sqlString);
    $sql->execute();
    $result = $sql->get_result();
    showQueryResult($result, $conn->error);

    if ($result->num_rows == 0) {
        return false;
    }

    return $result;
}


// CANCELLAZIONE RECORD

function DeleteRecord($conn, $table, $id)
{
    $sql = $conn->prepare("DELETE FROM $table WHERE id=?");
    $sql->bind_param("i", $id);
    $result = $sql->execute();
    return $result;
}

// CONTEGGIO RIGHE

function GetAllRows($conn, $table)
{
    $sqlString = "SELECT * FROM $table";
    $sql = $conn->prepare($sqlString);
    $sql->execute();
    $result = $sql->get_result();
    showQueryResult($result, $conn->error);

    if ($result) {
        $rowcount=mysqli_num_rows($result);
    }

    return $rowcount;
}

function GetAllUserFileRows($conn, $table,$roleID)
{
    $sqlString = "SELECT * FROM $table where role_id=$roleID";
    $sql = $conn->prepare($sqlString);
    $sql->execute();
    $result = $sql->get_result();
    showQueryResult($result, $conn->error);

    if ($result) {
        $rowcount=mysqli_num_rows($result);
    }

    return $rowcount;
}