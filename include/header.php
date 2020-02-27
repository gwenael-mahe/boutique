<nav>
    <ul>
        <li class="princ"><a href='index.php'> Accueil </a></li>
        <li class="princ"><a href='produit.php'> Produits </a>
            <ul class="niveau2">
                <li><a href='categorie.php'> cat 1 </a>
                    <ul class="niveau3">
                        <li><a href='sous_categorie.php'> Sous-cat 1 </a></li>
                        <li><a href='sous_categorie.php'> Sous-cat 2 </a></li>
                        <li><a href='sous_categorie.php'> Sous-cat 3 </a></li>
                    </ul>
                </li>
                <li><a href='categorie.php'> cat 2 </a>
                    <ul class="niveau3">
                        <li><a href='sous_categorie.php'> Sous-cat 1 </a></li>
                        <li><a href='sous_categorie.php'> Sous-cat 2 </a></li>
                        <li><a href='sous_categorie.php'> Sous-cat 3 </a></li>
                    </ul>
                </li>
                <li><a href='categorie.php'> cat 3 </a>
                    <ul class="niveau3">
                        <li><a href='sous_categorie.php'> Sous-cat 1 </a></li>
                        <li><a href='sous_categorie.php'> Sous-cat 2 </a></li>
                        <li><a href='sous_categorie.php'> Sous-cat 3 </a></li>
                    </ul>
                </li>
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
            <li> Bonjour toi ! </li>
            <li><a href='profil.php'> Mon profil </a></li>
        </ul>
        </li>
    <?php } else { ?>
        <ul class="niveau2">
            <li><a href='profil.php'> Mon profil </a></li>
            <li><a href='admin.php'> Gérer les produits </a></li>
            <li><a href='categorie.php'> Gérer les cat/sous_cat </a></li>
        </ul>
        </li>
    <?php } ?>

    <li class="princ"><a href='panier.php'> Panier </a></li>
    </ul>
</nav>