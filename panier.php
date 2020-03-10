<?php

include 'class/bdd.php';
include 'class/affichage.php';
include 'class/achat.php';


session_start();

$affichage = new affichage();
$_SESSION['id'] = 1;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Panier </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main id="mainpanier">
    <?php 
        $affichage->panier($_SESSION['id']);
        if($affichage->panier($_SESSION['id']) != false){
            ?>
                <a href="validation_panier.php">Valider votre panier</a>
            <?php
        }
    ?>
    
    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>