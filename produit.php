<?php
include 'class/admin.php';
include 'class/affichage.php';
include 'class/bdd.php';

session_start();

$affichage = new affichage();

if (isset($_POST['ajouterproduit'])) 
{
    // var_dump($_POST);
    $affichage->get('admin')->ajoutproduit($_POST['nom'], $_POST['prix'], $_POST['descriptionup'], $_POST['descriptiondown'], $_POST['sous_categorie']);
    header('location:produit.php');
}

if (isset($_POST['modifierproduit'])) 
{
    var_dump($_POST);
    $affichage->get('admin')->majproduit($_POST['nom'], $_POST['prix'], $_POST['descriptionup'], $_POST['descriptiondown'], $_POST['sous_categorie'],$_POST['id']);
    // header('location:produit.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Produits </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main>
        <?php if ($_SESSION['login'] == 'admin') { ?>

            <h1> Gestion des produits </h1>

            <section class='categorie'>

                <?php $affichage->adminproduit_modif($affichage->get('admin')->get('bdd')->get('produit'),$affichage->get('admin')->get('bdd')->get('souscategorie'));
                $affichage->adminproduit_ajout($affichage->get('admin')->get('bdd')->get('souscategorie')); ?>

            </section>

        <?php } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>