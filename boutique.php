<?php
include 'class/admin.php';
include 'class/affichage.php';
include 'class/bdd.php';

session_start();

$affichage = new affichage();

$nombreDePages = $affichage->get('admin')->get('bdd')->get('nombreDePages');
$page = $affichage->get('admin')->get('bdd')->get('page');

if (isset($_POST['ajouterproduit'])) {
    $affichage->get('admin')->ajoutproduit($_POST['nom'], $_POST['prix'], $_POST['descriptionup'], $_POST['descriptiondown'], $_POST['sous_categorie']);
    header('location:produit.php');
}

if (isset($_POST['modifierproduit'])) {
    $affichage->get('admin')->majproduit($_POST['nom'], $_POST['prix'], $_POST['descriptionup'], $_POST['descriptiondown'], $_POST['sous_categorie'], $_POST['id']);
    header('location:produit.php');
}

if (isset($_GET['recherche']) && !empty($_GET['recherche'])) {
    $affichage->get('admin')->get('bdd')->resultatrecherche($_GET['recherche']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title> Boutique </title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main>
        <section id='categorie_user' class='categorie'>

            <?php if (!isset($_GET['recherche'])) {
                $affichage->userlisteproduit($affichage->get('admin')->get('bdd')->get('produit'));
            } elseif (isset($_GET['recherche']) && !empty($_GET['recherche'])) {
                $affichage->userlisteproduitrecherche($affichage->get('admin')->get('bdd')->get('produitadmin'), $affichage->get('admin')->get('bdd')->get('recherche_produit'));
                if (!empty($affichage->get('lastmessage'))) {
                    echo $affichage->get('lastmessage');
                }
            } ?>

        </section>
        <aside >
            <?php
            if ($page > 1) { ?>
                <a href="?idpage=<?php echo $page - 1; ?>"> Page précédente - </a> 
            <?php
            }
            for ($i = 1; $i <= $nombreDePages; $i++) { ?>
                <a href="?idpage=<?php echo $i; ?>"><?php echo $i; ?>-</a>
            <?php }
            if ($page < $nombreDePages) { ?>
                <a href="?idpage=<?php echo $page + 1; ?>"> Page suivante </a>
            <?php } ?>
        </aside>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>