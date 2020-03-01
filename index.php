<?php 
include 'class/bdd.php';
include 'class/admin.php';
include 'class/affichage.php';

session_start(); 

$affichage = new affichage();

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

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>