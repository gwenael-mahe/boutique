<header>

    <?php $affichage->header(1); ?>

    <nav>
        <ul>
            <li class="princ"><a href='index.php'> Accueil </a></li>
            <li class="princ"><a href='boutique.php?idpage=1'> Boutique </a>
                <ul class="niveau2">
                    <?php foreach ($affichage->get('admin')->get('bdd')->get('categorie') as $cat) { ?>
                        <li><a href='categorie.php?idcat=<?php echo $cat['id']; ?>'> <?php echo $cat['nom']; ?></a>
                            <ul class='niveau3'>
                                <?php foreach ($affichage->get('admin')->get('bdd')->get('souscategorie') as $souscat) {
                                    if ($souscat['id_categorie'] == $cat['id']) { ?>
                                        <li><a href='sous_categorie.php?idsouscat=<?php echo $souscat['id']; ?>'> <?php echo $souscat['nom']; ?></a></li>
                                <?php }
                                } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li class="princ"> Compte
                <?php if (!isset($_SESSION['login'])) { ?>
                    <ul class="niveau2">
                        <li><a href='connexion.php'> Se connecter </a></li>
                        <li><a href='inscription.php'> S'inscrire </a></li>
                    </ul>
            </li>
        <?php } elseif ($_SESSION['login'] != 'admin') { ?>
            <ul class="niveau2">
                <li> Bonjour <?php echo $_SESSION['login']; ?> ! </li>
                <li><a href='profil.php'> Mon profil </a></li>
                <li><a href='include/delete.php?iduser=<?php echo $_SESSION['id']; ?>'> Déconnexion </a></li>
            </ul>
            </li>
        <?php } else { ?>
            <ul class="niveau2">
                <li><a href='profil.php'> Mon profil </a></li>
                <li><a href='produit.php'> Gérer les produits </a></li>
                <li><a href='categorie.php'> Gérer les catégorie </a></li>
                <li><a href='sous_categorie.php'> Gérer les sous-catégorie </a></li>
                <li><a href='include/delete.php?iduser=<?php echo $_SESSION['id']; ?>'> Déconnexion </a></li>
            </ul>
            </li>
        <?php } ?>

        <li class="princ"><a href='panier.php'> Panier </a></li>
        <li class="princ"><a href='contact.php'> Contact </a></li>
        </ul>
    </nav>

</header>