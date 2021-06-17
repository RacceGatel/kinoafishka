<?php
    include "bd.php";
    $idp = htmlspecialchars($_POST["param1"]);
    $idr = htmlspecialchars($_POST["param2"]);
    $idc = htmlspecialchars($_POST["param3"]);
    $idf = htmlspecialchars($_POST["param4"]);

    $qr = $bd -> query("UPDATE place SET free=0 WHERE (id LIKE $idp) AND (row LIKE $idr) AND (idcinema LIKE $idc) AND (idfilm LIKE $idf)")
?>