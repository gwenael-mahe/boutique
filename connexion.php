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

if (isset($_POST['connexion'])) {
    $user->connexion($_POST['login'], $_POST['password']);
    $_SESSION['id'] = $user->getid();
    $_SESSION['login'] = $user->getlogin();
    $_SESSION['mail'] = $user->getmail();
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
    <title> Connexion </title>
</head>

<body>

    <?php include 'include/header.php' ?>

    <main>

        <h1> Connexion </h1>

        <form class='module_co' action='' method='POST'>
            <div class='input'>
                <label> Login </label>
                <input type='texte' name='login' required />
            </div>
            <div class='input'>
                <label> Mot de passe </label>
                <input type='password' name='password' required />
            </div>

            <input type='submit' name='connexion' value="Se connecter" />

            <?php echo $user->getlastmessage(); ?>

            <a href='inscription.php'> S'inscrire </a>
        </form>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>