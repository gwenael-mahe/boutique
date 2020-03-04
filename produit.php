<?php
include 'class/admin.php';
include 'class/affichage.php';
include 'class/bdd.php';

session_start();

$affichage = new affichage();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Fiche Produit </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main>
        <?php if ($_SESSION['login'] == 'admin') { ?>

            <h1> Gestion des produits </h1>

            <section class='categorie'>

                <?php $affichage->adminproduit_modif($affichage->get('admin')->get('bdd')->get('produitadmin'), $affichage->get('admin')->get('bdd')->get('souscategorie'));
                $affichage->adminproduit_ajout($affichage->get('admin')->get('bdd')->get('souscategorie')); ?>

            </section>

        <?php } else { ?>


        <?php } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>