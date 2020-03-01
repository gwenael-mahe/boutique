<?php
include 'class/admin.php';
include 'class/affichage.php';
include 'class/bdd.php';

session_start();

$affichage = new affichage();

if (isset($_POST['modifier_cat'])) {
    $affichage->get('admin')->traitementimg($_POST['nom'], $_POST['id']);
    $affichage->get('admin')->majcategorie($_POST['nom'], $_POST['description'], $affichage->get('admin')->get('filesimg'), $_POST['id']);
    header('location:admin.php');
}

if (isset($_POST['ajoutcat'])) {
    $affichage->get('admin')->traitementimg($_POST['nom']);
    $affichage->get('admin')->ajoutcategorie($_POST['nom'], $_POST['description'], $affichage->get('admin')->get('filesimg'));
    header('location:admin.php');
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
    <header>

        <?php include 'include/header.php' ?>

    </header>


    <main>
        <?php if ($_SESSION['login'] == 'admin') { ?>

            <h1> Gestion des Catégories </h1>

            <section class='categorie'>

                <?php
                $affichage->admincat();
                ?>

            </section>
        <?php } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>