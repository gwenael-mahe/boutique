<?php

include '../class/bdd.php';
include '../class/admin.php';

$moi = new admin();

if(isset($_GET['idcat']))
{
    $moi->deletecategorie($_GET['idcat']);
}

header('Location:../admin.php');