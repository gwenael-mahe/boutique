<?php
include 'class/admin.php';
include 'class/affichage.php';
include 'class/bdd.php';

session_start();

$affichage = new affichage();

if (isset($_POST['modifiersouscat'])) {
    $affichage->get('admin')->majsouscategorie($_POST['nom'], $_POST['description'], $_POST['categorie'], $_POST['id']);
    header('location:sous_categorie.php');
}

if (isset($_POST['ajoutersouscat'])) {
    $affichage->get('admin')->ajoutsouscategorie($_POST['nom'], $_POST['description'], $_POST['categorie']);
    header('location:sous_categorie.php');
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

            <h1> Gestion des Sous-Catégories </h1>

            <section class='categorie'>

                <?php $affichage->adminsouscat_modif($affichage->get('admin')->get('bdd')->get('souscategorie'), $affichage->get('admin')->get('bdd')->get('categorie'));
                $affichage->adminsouscat_ajout($affichage->get('admin')->get('bdd')->get('categorie')); ?>

            </section>

        <?php } else { ?>

            <section id='categorie_user' class='categorie'>

                <?php $affichage->usersouscat($affichage->get('admin')->get('bdd')->get('produitadmin'), $affichage->get('admin')->get('bdd')->get('souscategorie'), $affichage->get('admin')->get('bdd')->get('categorie')); ?>

            </section>

        <?php } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>