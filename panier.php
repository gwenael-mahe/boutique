<?php

include 'class/bdd.php';
include 'class/affichage.php';
include 'class/achat.php';
include 'class/admin.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

$affichage = new affichage();
$achat = new achat();
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
        <h1>Votre panier</h1>

        <article>
            <p>Vous avez actuellement <?php echo $achat->countarticle($_SESSION['id']) ?> article dans votre panier</p>
        </article>
        
        <?php
        $affichage->panier($_SESSION['id']);
        if ($achat->countarticle($_SESSION['id']) != 0) {
        ?>
            <a href="validation_panier.php">Valider votre panier</a>
        <?php
        }
        ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>