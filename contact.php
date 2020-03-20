<?php
include 'class/bdd.php';
include 'class/admin.php';
include 'class/affichage.php';

session_start();

$affichage = new affichage();

if (isset($_GET['recherche'])) {
    header('location:boutique.php?recherche=' . $_GET['recherche']);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/rncp.css">
    <title>Contact</title>
</head>

<body>
    <?php include 'include/header.php' ?>

    <main>

        <h1> Contact </h1>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.4579745752158!2d5.367697315714783!3d43.304671482915325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9c0eb8678dca9%3A0x17e14e158f103c9c!2s8%20Rue%20d&#39;hozier%2C%2013002%20Marseille!5e0!3m2!1sfr!2sfr!4v1584436639193!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

        <section>
            <p>Nous sommes joignable par email : <a href="mailto:mathilde.roussier@laplateforme.io"> Contactez-nous ! </a></p>
            <p>Et également par téléphone : (+33) 491493939</p>
        </section>

    </main>

    <?php include 'include/footer.php' ?>


</body>

</html>