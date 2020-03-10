<?php
include 'class/bdd.php';
include 'class/achat.php';

$achat = new achat();
$achat->removefromcart($_GET['id']);
header('Location:../panier.php');

?>