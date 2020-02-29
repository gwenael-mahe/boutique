    <footer>

        <aside> Merci d'être aussi nombreux à nous suivre ! Facebook / instagram / twitter </aside>

        <section class='footer_section'>
            <article> <a href='index.php'> Accueil </a> </article>
            <article id='border1'>

                <ul>
                    <li> <a href='produit.php'> Produits </a> </li>
                    <ul>
                        <li><a href='categorie.php'> cat 1 </a>
                            <ul>
                                <li><a href='sous_categorie.php'> Sous-cat 1 </a></li>
                                <li><a href='sous_categorie.php'> Sous-cat 2 </a></li>
                                <li><a href='sous_categorie.php'> Sous-cat 3 </a></li>
                            </ul>
                        </li>
                        <li><a href='categorie.php'> cat 2 </a>
                            <ul>
                                <li><a href='sous_categorie.php'> Sous-cat 1 </a></li>
                                <li><a href='sous_categorie.php'> Sous-cat 2 </a></li>
                                <li><a href='sous_categorie.php'> Sous-cat 3 </a></li>
                            </ul>
                        </li>
                        <li><a href='categorie.php'> cat 3 </a>
                            <ul>
                                <li><a href='sous_categorie.php'> Sous-cat 1 </a></li>
                                <li><a href='sous_categorie.php'> Sous-cat 2 </a></li>
                                <li><a href='sous_categorie.php'> Sous-cat 3 </a></li>
                            </ul>
                        </li>
                    </ul>
                </ul>

            </article>

            <article id='border2'> Compte
                <?php if (!isset($_SESSION['login'])) { ?>
                    <ul>
                        <li><a href='connexion.php'> Se connecter </a></li>
                        <li><a href='inscription.php'> S'inscrire </a></li>
                    </ul>
                    </li>
                <?php } elseif ($_SESSION['login'] != 'admin') { ?>
                    <ul>
                        <li> Bonjour <?php echo $_SESSION['login']; ?> ! </li>
                        <li><a href='profil.php'> Mon profil </a></li>
                    </ul>
                    </li>
                <?php } else { ?>
                    <ul>
                        <li><a href='profil.php'> Mon profil </a></li>
                        <li><a href='admin.php'> Gérer les produits </a></li>
                        <li><a href='categorie.php'> Gérer les cat/sous_cat </a></li>
                    </ul>
                    </li>
                <?php } ?>
            </article>

            <article id='border2'> <a href='panier.php'> Panier </a> </article>
            <article> <a href='contact.php'> Contact </a> </article>

        </section>

        <aside> Copyright Gwenaël & Mathilde </aside>

    </footer>