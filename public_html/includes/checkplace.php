<?php 
    include "bd.php";
    $idp = htmlspecialchars($_POST["param1"]);
    $idr = htmlspecialchars($_POST["param2"]);
    $idc = htmlspecialchars($_POST["param3"]);
    $idf = htmlspecialchars($_POST["param4"]);
    $qr = $bd->query("SELECT free FROM place WHERE (id LIKE $idp) AND (row LIKE $idr) AND (idcinema LIKE $idc) AND (idfilm LIKE $idf) LIMIT 1");
    $row=$qr->fetch_row();
    echo htmlspecialchars($row[0]);
    
?>