<?php

include '../class/bdd.php';
include '../class/admin.php';

$moi = new admin();

if(isset($_GET['idcat']))
{
    $moi->deletecategorie($_GET['idcat']);
}

if(isset($_GET['idsouscat']))
{
    $moi->deletesouscategorie($_GET['idsouscat']);
}

// header('Location:../categorie.php');