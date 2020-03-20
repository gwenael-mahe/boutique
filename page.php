<?php

include 'class/bdd.php';
include 'class/affichage.php';
include 'class/achat.php';
include 'class/admin.php';

session_start();

$affichage = new affichage();

if (isset($_POST['modifierpage'])) {
    $affichage->get('admin')->majpage($_POST['titre'], $_POST['description']);
    header('location:page.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Page </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main>
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') { ?>

            <h1> Gestion du header </h1>

            <section class='categorie'>

                <?php $affichage->adminpage($affichage->get('admin')->get('bdd')->get('adminpage')); ?>

            </section>

        <?php } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>