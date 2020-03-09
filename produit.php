<?php

include 'class/bdd.php';
include 'class/affichage.php';
include 'class/achat.php';


session_start();

$affichage = new affichage();
$achat = new achat();

if(isset($_POST['add'])){
    $achat->addtocart($_GET['id'],$_SESSION['id'],$_POST['quantity']);
}
if(isset($_POST['send'])){
    $affichage->addcommentaire($_SESSION['id'],$_POST["com"],$_GET['id'],$_POST['note']);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Produit </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main id="mainproduit">
    <?php
    $affichage->product($_GET['id']);
    $affichage->notation($_GET['id']);
    $affichage->commentaire($_GET['id']);
    if(isset($_SESSION['login'])){
        $affichage->formmessage();
    }
    ?>
    </main>

    <?php //include 'include/footer.php' ?>

</body>

</html>