<?php

include '../class/bdd.php';
include '../class/admin.php';
include '../class/user.php';

session_start();

$moi = new admin();
$user = new user();

if(isset($_GET['idcat']))
{
    $moi->deletecategorie($_GET['idcat']);
    header('Location:../categorie.php');
}

if(isset($_GET['idsouscat']))
{
    $moi->deletesouscategorie($_GET['idsouscat']);
    header('Location:../sous_categorie.php');
}

if(isset($_GET['idproduit']))
{
    $moi->deleteproduit($_GET['idproduit']);
    header('Location:../produit.php');
}

if(isset($_GET['iduser']))
{
    $user->disconnect();
    header('Location:../index.php');
}