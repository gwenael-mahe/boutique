<?php

include 'class/bdd.php';
include 'class/user.php';

session_start();

$user = new user();

if (isset($_POST['modification'])) {
    $user->profil($_POST['id'], $_POST['old_password'], $_POST['login'], $_POST['email'], $_POST['password']);

    if ($user->getlastmessage() == 'Modification prise en compte') {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['mail'] = $_POST['email'];
    }
}

if (isset($_POST['deconnexion'])) {
    $user->disconnect();
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

            <form action='' method='POST'>
                <input type='submit' name='deconnexion' value="Se déconnecter" />
            </form>

        </section>

        <section>

            <h1> Historique d'achat </h1>


        </section>

        <section>

            <h1> Mon panier </h1>


        </section>

    </main>

    <?php include 'include/footer.php' ?>

</body>

</html>