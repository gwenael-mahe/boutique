<?php

include 'class/bdd.php';
include 'class/user.php';
include 'class/admin.php';
include 'class/affichage.php';

session_start();

$user = new user();
$affichage = new affichage();

if (isset($_SESSION['id'])) {
    header('location:index.php');
}

if (isset($_POST['inscription'])) {
    $user->inscription($_POST['login'], $_POST['password'], $_POST['password_conf'], $_POST['email']);
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
    <title> Inscription </title>
</head>

<body>

    <?php include 'include/header.php' ?>

    <main>

        <h1> Inscription </h1>

        <form class='module_co' action='' method='POST'>
            <div class='input'>
                <label> Login </label>
                <input type='texte' name='login' required />
            </div>
            <div class='input'>
                <label> Email </label>
                <input type='email' name='email' required />
            </div>
            <div class='input'>
                <label> Mot de passe </label>
                <input type='password' name='password' required />
            </div>
            <div class='input'>
                <label> Confirmation mot de passe </label>
                <input type='password' name='password_conf' required />
            </div>

            <input type='submit' name='inscription' value="S'inscrire" />

            <?php echo $user->getlastmessage(); ?>

            <a href='connexion.php'> Se connecter </a>
        </form>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>