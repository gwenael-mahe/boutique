    <footer>

        <aside> Merci d'être aussi nombreux à nous suivre ! Facebook / instagram / twitter </aside>

        <section class='footer_section'>
            <article> <a href='index.php'> Accueil </a> </article>
            <article id='border1'>

                <ul>
                    <li class="princ"><a href='boutique.php?idpage=1'> Boutique </a> </li>
                    <ul class="niveau2">
                        <?php foreach ($affichage->get('admin')->get('bdd')->get('categorie') as $cat) { ?>
                            <li><a href='categorie?idcat=<?php echo $cat['id']; ?>'> <?php echo $cat['nom']; ?></a>
                                <ul class='niveau3'>
                                    <?php foreach ($affichage->get('admin')->get('bdd')->get('souscategorie') as $souscat) {
                                        if ($souscat['id_categorie'] == $cat['id']) { ?>
                                            <li><a href='souscategorie?idsouscat=<?php echo $souscat['id']; ?>'> <?php echo $souscat['nom']; ?></a></li>
                                    <?php }
                                    } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </ul>

            </article>

            <article id='border2'> Compte
                <?php if (!isset($_SESSION['login'])) { ?>
                    <ul>
                        <li><a href='connexion.php'> Se connecter </a></li>
                        <li><a href='inscription.php'> S'inscrire </a></li>
                    </ul>
                <?php } elseif ($_SESSION['login'] != 'admin') { ?>
                    <ul class="niveau2">
                        <li> Bonjour <?php echo $_SESSION['login']; ?> ! </li>
                        <li><a href='profil.php'> Mon profil </a></li>
                        <li><a href='include/delete.php?iduser=<?php echo $_SESSION['id']; ?>'> Déconnexion </a></li>
                    </ul>
                <?php } else { ?>
                    <ul class="niveau2">
                        <li><a href='profil.php'> Mon profil </a></li>
                        <li><a href='produit.php'> Gérer les produits </a></li>
                        <li><a href='categorie.php'> Gérer les catégorie </a></li>
                        <li><a href='sous_categorie.php'> Gérer les sous-catégorie </a></li>
                        <li><a href='include/delete.php?iduser=<?php echo $_SESSION['id']; ?>'> Déconnexion </a></li>
                    </ul>
                <?php } ?>
            </article>

            <article id='border2'> <a href='panier.php'> Panier </a> </article>
            <article> <a href='contact.php'> Contact </a> </article>

        </section>

        <aside> Copyright Gwenaël & Mathilde </aside>

    </footer>