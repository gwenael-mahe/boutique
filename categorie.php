<?php
include 'class/admin.php';
include 'class/affichage.php';
include 'class/bdd.php';

session_start();

$affichage = new affichage();

if (isset($_POST['modifiercat'])) {
    $affichage->get('admin')->majcategorie($_POST['nom'], $_POST['description'], $_POST['id']);
    header('location:categorie.php');
}

if (isset($_POST['ajoutercat'])) {
    $affichage->get('admin')->ajoutcategorie($_POST['nom'], $_POST['description']);
    header('location:categorie.php');
}

?>

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
        <?php if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') { ?>

                <h1> Gestion des Catégories </h1>

                <section class='categorie'>

                    <?php $affichage->admincat($affichage->get('admin')->get('bdd')->get('categorie')); ?>

                </section>

            <?php
            } else { ?>

                <section id='categorie_user' class='categorie'>

                    <?php $affichage->usercat($affichage->get('admin')->get('bdd')->get('produitadmin'),$affichage->get('admin')->get('bdd')->get('souscategorie'),$affichage->get('admin')->get('bdd')->get('categorie')); ?>

                </section>

        <?php
            } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>