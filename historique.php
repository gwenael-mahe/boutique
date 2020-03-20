<?php

include 'class/bdd.php';
include 'class/affichage.php';
include 'class/achat.php';
include 'class/admin.php';


session_start();

$affichage = new affichage();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Votre historique </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main>

        <h1> Historique d'achat </h1>
        <?php
        $affichage->historiquedetail($_GET['id']);
        ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>