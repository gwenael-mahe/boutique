<?php
include 'class/admin.php';
include 'class/affichage.php';
include 'class/bdd.php';

session_start();

$affichage = new affichage();

if (isset($_POST['modifiercat'])) {
    var_dump($_POST);
    $affichage->get('admin')->traitementimg($_POST['nom']);
    $affichage->get('admin')->majcategorie($_POST['nom'], $_POST['description'], $affichage->get('admin')->get('filesimg'), $_POST['id']);
    header('location:categorie.php');
}

if (isset($_POST['ajoutercate'])) {
    var_dump($_POST);
    $affichage->get('admin')->traitementimg($_POST['nom']);
    $affichage->get('admin')->ajoutcategorie($_POST['nom'], $_POST['description'], $affichage->get('admin')->get('filesimg'));
    header('location:categorie.php');
}

if (isset($_POST['modifiersouscat'])) {
    $affichage->get('admin')->traitementimg($_POST['nom']);
    $affichage->get('admin')->majsouscategorie($_POST['nom'], $_POST['description'], $_POST['categorie'], $affichage->get('admin')->get('filesimg'), $_POST['id']);
    header('location:categorie.php');
}

if (isset($_POST['ajoutersouscat'])) {
    $affichage->get('admin')->traitementimg($_POST['nom']);
    $affichage->get('admin')->ajoutsouscategorie($_POST['nom'], $_POST['description'], $_POST['categorie'],$affichage->get('admin')->get('filesimg'));
    header('location:categorie.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Admin </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main>
        <?php if ($_SESSION['login'] == 'admin') { ?>

            <h1> Gestion des Catégories </h1>

            <section class='categorie'>

                <?php $affichage->admincat($affichage->get('admin')->get('bdd')->get('categorie')); ?>

            </section>

            <h1> Gestion des Sous-Catégories </h1>

            <section class='categorie'>

                <?php $affichage->adminsouscat($affichage->get('admin')->get('bdd')->get('souscategorie'),$affichage->get('admin')->get('bdd')->get('categorie')); ?>

            </section>
        <?php } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>