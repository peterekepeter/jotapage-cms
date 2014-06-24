<?php
    include "connect.php";

    $db = connect();
    $sql = "SELECT idposter FROM poster where `name` = ?";
    $st = $db->prepare($sql);

    //echo $_GET['user']."</br>";

    //print_r($st);
    $st->execute(array($_GET['user']));
    //print_r($st);
    //echo "</br>";
    $row = $st->fetch();
    //print_r($row);
    //echo "</br>";

    if (isset($row)&&isset($row['idposter']))
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
?>