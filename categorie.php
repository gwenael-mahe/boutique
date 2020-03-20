<?php
include 'class/admin.php';
include 'class/affichage.php';
include 'class/bdd.php';

session_start();

if (isset(explode('?', $_SERVER['REQUEST_URI'])[1]) == false) {
    header('location:index.php');
} else {
    if (explode('?', explode('=', $_SERVER['REQUEST_URI'])[0])[1] != 'idcat') {
        header('location:index.php');
    }
}

$affichage = new affichage();

if (isset($_POST['modifiercat'])) {
    $affichage->get('admin')->majcategorie($_POST['nom'], $_POST['description'], $_POST['id']);
    header('location:categorie.php');
}

if (isset($_POST['ajoutercat'])) {
    $affichage->get('admin')->ajoutcategorie($_POST['nom'], $_POST['description']);
    header('location:categorie.php');
}

if (isset($_GET['recherche'])) {
    header('location:boutique.php?recherche=' . $_GET['recherche']);
} ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Catégorie_admin </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main>
        <?php if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin' && (isset(explode('?', $_SERVER['REQUEST_URI'])[1]) == false)) { ?>

            <h1> Gestion des Catégories </h1>

            <section class='categorie'>

                <?php $affichage->admincat_modif($affichage->get('admin')->get('bdd')->get('categorie'));
                $affichage->admincat_ajout(); ?>

            </section>

        <?php
        } else { ?>

            <section id='categorie_user' class='categorie'>

                <?php $affichage->usercat($affichage->get('admin')->get('bdd')->get('produitadmin'), $affichage->get('admin')->get('bdd')->get('souscategorie'), $affichage->get('admin')->get('bdd')->get('categorie')); ?>

            </section>

        <?php
        } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>