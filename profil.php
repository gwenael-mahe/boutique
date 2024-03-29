<?php

include 'class/bdd.php';
include 'class/user.php';
include 'class/admin.php';
include 'class/affichage.php';
include "class/achat.php";

session_start();

if (!isset($_SESSION['login'])) {
    header('location:index.php');
}

$user = new user();
$affichage = new affichage();
$achat = new achat();

if (isset($_POST['modification'])) {
    $user->profil($_POST['id'], $_POST['old_password'], $_POST['login'], $_POST['email'], $_POST['password']);

    if ($user->getlastmessage() == 'Modification prise en compte') {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['mail'] = $_POST['email'];
    }
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
    <title> Profil </title>
</head>

<body>

    <?php include 'include/header.php' ?>

    <main class='main_profil'>

        <section class='profil'>

            <h1> Mon profil </h1>

            <form class='profil_form' action='' method='POST'>
                <div class='input'>
                    <label> Login </label>
                    <input type='texte' name='login' value='<?php echo $_SESSION['login']; ?>' />
                    <input type='hidden' name='id' value='<?php echo $_SESSION['id']; ?>' />
                </div>
                <div class='input'>
                    <label> Email </label>
                    <input type='email' name='email' value='<?php echo $_SESSION['mail']; ?>' />
                </div>
                <div class='input'>
                    <label> Mot de passe </label>
                    <input type='password' name='password' />
                </div>
                <div class='input'>
                    <label> Ancien mot de passe * </label>
                    <input type='password' name='old_password' required />
                </div>

                <input type='submit' name='modification' value="Modifier" />

                <?php echo $user->getlastmessage(); ?>

            </form>

        </section>

        <?php if ($_SESSION['login'] != 'admin') { ?>

            <section class='profil'>

                <h1> Historique d'achat </h1>
                <?php echo $affichage->historique($_SESSION['id']) ?>

            </section>

            <section class='profil'>

                <h1> Mon panier </h1>
                <article>
                    <p>Vous avez actuellement <?php echo $achat->countarticle($_SESSION['id']) ?> article dans votre panier</p>
                </article>

            </section>

        <?php } else { ?>

            <section class='gestion_site'>

                <h1> Gestion du site </h1>

                <ul>
                    <li> <a href='categorie.php'> Gérer les catégories </a> </li>
                    <li> <a href='sous_categorie.php'> Gérer les sous-catégories </a> </li>
                    <li> <a href='produit.php'> Gérer les produits </a> </li>
                    <li> <a href='page.php'> Gérer le header </a> </li>
                </ul>

            </section>

        <?php } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>