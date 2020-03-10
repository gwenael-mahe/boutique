<?php

include 'class/bdd.php';
include 'class/affichage.php';
include 'class/achat.php';
include 'class/admin.php';


session_start();

$achat = new achat();
$prix = $achat->pricecalculation($_SESSION['id']);
if(isset($_POST["send"])){
    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && strlen($_POST["cbname"]) == 16 && !empty($_POST["end"]) && strlen($_POST["crypto"]) == 3){
        $achat->addtohistory($_SESSION['id'],$prix);
        //$achat->resetcart($_SESSION['id']);
    }
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
    <input type="number" name="end">
    <label>Cryptograme</label>
    <input type="number" name="crypto">
    <input type="submit" name="send">
    </form>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>