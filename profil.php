<?php

include 'class/bdd.php';
include 'class/user.php';
include 'class/admin.php';
include 'class/affichage.php';

session_start();

$user = new user();
$affichage = new affichage();

if (isset($_POST['modification'])) {
    $user->profil($_POST['id'], $_POST['old_password'], $_POST['login'], $_POST['email'], $_POST['password']);

    if ($user->getlastmessage() == 'Modification prise en compte') {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['mail'] = $_POST['email'];
    }
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
                    <label> Vieux mot de passe * </label>
                    <input type='password' name='old_password' required />
                </div>

                <input type='submit' name='modification' value="Modifier" />

                <?php echo $user->getlastmessage(); ?>

            </form>

        </section>

        <?php if ($_SESSION['login'] != 'admin') { ?>

            <section>

                <h1> Historique d'achat </h1>

            </section>

            <section>

                <h1> Mon panier </h1>

            </section>

        <?php } else { ?>

            <section class='gestion_site'>

                <h1> Gestion du site </h1>

                <ul>
                    <li> <a href='categorie.php'> Gérer les catégories et les sous-catégories </a> </li>
                    <li> <a href='#'> Gérer les produits </a> </li>
                    <li> <a href='#'> Gérer les différentes pages </a> </li>
                </ul>

            </section>

        <?php } ?>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>