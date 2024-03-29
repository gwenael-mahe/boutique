<?php
include 'class/bdd.php';
include 'class/admin.php';
include 'class/affichage.php';

session_start();

$affichage = new affichage();

if (isset($_GET['recherche'])) {
    header('location:boutique.php?recherche=' . $_GET['recherche']);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Accueil </title>
</head>

<body>

    <?php include 'include/header.php' ?>

    <main>

        <section class='categorie' id='categorie_user'>

            <?php $affichage->affiche_cat($affichage->get('admin')->get('bdd')->get('categorie')); ?>

        </section>

        <section class='categorie' id='categorie_user'>

            <?php $affichage->affiche_nouveaute($affichage->get('admin')->get('bdd')->get('nouveaute')); ?>

        </section>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>