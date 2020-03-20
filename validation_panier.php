<?php

include 'class/bdd.php';
include 'class/affichage.php';
include 'class/achat.php';
include 'class/admin.php';


session_start();

$achat = new achat();
$affichage = new affichage();
$prix = $achat->pricecalculation($_SESSION['id']);
if(isset($_POST["send"])){
    echo "test";
    $achat->addtohistory($_SESSION['id'],$prix);
    $achat->resetcart($_SESSION['id']);
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Panier </title>
</head>

<body>
    <?php include 'include/header.php' ?>
    <main id="mainvalidation">

    <form action="validation_panier.php" method="post">
    <label>Nom</label>
    <input type="text" name="nom">
    <label>Prénom</label>
    <input type="text" name="prenom">
    <label>Numéro de carte bleu</label>
    <input type="number" name="cbname">
    <label>Expire</label>
    <input type="month" name="end">
    <label>Cryptograme</label>
    <input type="number" name="crypto">
    <input type="submit" name="send">
    </form>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>