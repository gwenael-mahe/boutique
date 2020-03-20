<?php

include 'class/bdd.php';
include 'class/affichage.php';
include 'class/achat.php';
include 'class/admin.php';


session_start();

$affichage = new affichage();
$achat = new achat();

if(isset($_POST['addtocart'])){
    $achat->addtocart($_GET['id'],$_SESSION['id'],$_POST['quantity']);
}
if(isset($_POST['send'])){
    $affichage->addcommentaire($_SESSION['id'],$_POST["com"],$_GET['id'],$_POST['note']);
}
if (isset($_POST['modifierproduit'])) {
    $affichage->get('admin')->majproduit($_POST['nom'], $_POST['prix'], addslashes($_POST['descriptionup']), addslashes($_POST['descriptiondown']), $_POST['sous_categorie'], $_POST['id']);
    header('location:produit.php');
}

if (isset($_POST['ajouterproduit'])) {
    $affichage->get('admin')->ajoutproduit($_POST['nom'], $_POST['prix'], addslashes($_POST['descriptionup']), addslashes($_POST['descriptiondown']), $_POST['sous_categorie']);
    header('location:produit.php');
}

if (isset($_GET['recherche'])) {
    header('location:boutique.php?recherche=' . $_GET['recherche']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Produit </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main id="mainproduit">
    <?php
    if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin' && (isset(explode('?', $_SERVER['REQUEST_URI'])[1]) == false)) { ?>

        <h1> Gestion des produits </h1>
        
        <section class='categorie'>
        
            <?php $affichage->adminproduit_modif($affichage->get('admin')->get('bdd')->get('produitadmin'), $affichage->get('admin')->get('bdd')->get('souscategorie'));
            $affichage->adminproduit_ajout($affichage->get('admin')->get('bdd')->get('souscategorie')); ?>
        
        </section>
        
        <?php } else { ?>
        
        
        <?php } 
    if(isset(explode('?', $_SERVER['REQUEST_URI'])[1]) == true){
        $affichage->product($_GET['id']);
        $affichage->notation($_GET['id']);
        $affichage->commentaire($_GET['id']);
        if(isset($_SESSION['login'])){
            $affichage->formmessage();
        }
    }
    
    ?>
    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>