<?php

class affichage
{

    private $admin;
    private $bdd;
    private $lastmessage;

    public function __construct()
    {
        $bdd = new bdd();
        $this->bdd = $bdd->getco();
        $admin = new admin();
        $this->admin = $admin;
    }
    //-------------------- page produit --------------------//
    public function product($id)
    {
        $request = "SELECT id,nom,prix,descriptionup,descriptiondown,img FROM product WHERE id = $id";
        $query = mysqli_query($this->bdd, $request);
        $fetch = mysqli_fetch_assoc($query);
        // var_dump($fetch);
        if(!empty($fetch)){
            ?>
                <section class="sectionproduit">
                    <article class="articleproduitup">
                        <img src="<?php echo $fetch['img'] ?>" class="imgproduct">
                        <p><?php echo $fetch['descriptionup'] ?></p>
                    </article>
                    <article class="articleproduitdown">
                        <div class="divproduitup">
                            <p><?php echo $fetch['descriptiondown'] ?></p>
                            <p><?php echo $fetch['prix'] ?>€</p>
                        </div>
                        <div class="divproduitdown">
                            <?php
                            if(isset($_SESSION['login'])){
                                ?>
                                <form method="post" class="formproduit">
                                <label>Quantité</label>
                                <select name="quantity">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                <input type="submit" value="addtocart" name="addtocart">
                            </form>
                            <?php
                            }
                            ?>
                        </div>
                    </article>
                    
                </section>
            <?php
        }
        else{
            return false;
        }
        
    }
    public function formmessage()
    {
        ?>
            <section id="formproduit">
                <form action="" method="post">
                    <label>Note</label>
                    <select name="note">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    <label>Votre avis:</label>
                    <input type="text" name="com">
                    <input type="submit" value="envoyer" name="send">
            </form>
        </section>
        <?php
    }
    public function addcommentaire($iduser,$com,$idproduct,$avis){
        $request = "INSERT INTO commentaires(id_user,message,date,id_product) VALUES ($iduser,\"" . $com . "\",NOW(),$idproduct)";
        var_dump($request);
        $query = mysqli_query($this->bdd,$request);
        $requestavis = "INSERT INTO `avis`(`id_user`, `id_produit`, `id_message`, `notation`) VALUES ($iduser,$idproduct,LAST_INSERT_ID(),$avis)";
        $queryavis = mysqli_query($this->bdd, $requestavis);
    }
    public function notation($id)
    {
        $request = "SELECT AVG(notation) FROM avis WHERE id_produit = $id";
        $query = mysqli_query($this->bdd, $request);
        $fetch = mysqli_fetch_all($query);
        //var_dump($fetch);
        if (!empty($fetch)) {
        ?>
            <section id="notation">
                <p>Avis utilisateurs : <?= $fetch[0][0] ?></p><img src="img/product/etoile.png" class="etoile">
            </section>
            <?php
        }
    }
    public function commentaire($id)
    {
        $request = "SELECT commentaires.message,commentaires.date,user.login,avis.notation FROM commentaires INNER JOIN user ON commentaires.id_user = user.id INNER JOIN avis ON commentaires.id = avis.id_message WHERE commentaires.id_product = $id";
        $query = mysqli_query($this->bdd, $request);
        $fetch = mysqli_fetch_all($query);
        if(!empty($fetch)){
            foreach($fetch as list($com,$date,$login,$avis)){
                ?>
                    <section class="sectionnotation">
                        <article class="articlenotationup">
                            <p>Par <?php echo $login?></p>
                            <p>Le <?php echo $date ?></p>
                        </article>
                        <article class="articlenotationdown">
                            <p><?php echo $com ?></p>
                            <p class="pnot"><?php echo $avis ?><img src="img/product/etoile.png" class="etoile"></p>
                        </article>
                    </section>
                <?php
            }
        } else
            return false;
    }
    //-------------------- page panier --------------------//
    public function panier($iduser)
    {
        $request = "SELECT product.img,product.nom,product.prix,panier.quantite,panier.id FROM panier INNER JOIN product ON panier.id_product = product.id WHERE panier.id_user = $iduser";
        $query = mysqli_query($this->bdd, $request);
        $fetch = mysqli_fetch_all($query);
        if (!empty($fetch)) {
            ?>
            <section>
                <table class="blueTable">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Nom</td>
                            <td>Prix</td>
                            <td>Nombre</td>
                            <td>Supprimer</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($fetch as list($img, $nom, $prix, $quantity, $id)) {
                        ?>
                            <tr>
                                <td><img src="<?php echo $img ?>" class="imgpanier"></td>
                                <td><?php echo $nom ?></td>
                                <td><?php echo $prix ?></td>
                                <td><?php echo $quantity ?></td>
                                <td><a href="include/deletepanier.php?id=<?php echo $id ?>"><img src="img/product/delete.png" class="deletepanier"></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        <?php
        } else
            return false;
    }
    // --------- Header --------- //

    public function header($id)
    {
        $request = "SELECT titre,description,img FROM basicpage WHERE id_page = $id";
        $query = mysqli_query($this->bdd, $request);
        $fetch = mysqli_fetch_assoc($query); ?>

        <section>

            <aside> <img src='<?php echo $fetch['img']; ?>' id="imgheader"> </aside>

            <article>
                <h1> <?php echo $fetch['titre']; ?></h1>
                <p> <?php echo $fetch['description']; ?></p>
            </article>

            <form action='' method='GET'>
                <input type='search' name='recherche' placeholder="Recherche..." />
                <input type='submit' value='Rechercher'/>
            </form>

        </section>
        <?php
    }

    // ------------- Affichage admin ---------------- //

    // ----- page ----- //

    public function adminpage($page)
    {
        if (!empty($page)) {
            foreach ($page as $page_infos) { ?>
                <form id='nop' action='' method='POST' enctype="multipart/form-data">
                    <div>
                        <img src='<?php echo $page_infos['img'] ?>' alt='img_page' />
                        <input type="file" name="img" />
                    </div>
                    <input type='hidden' name='id' value='<?php echo $page_infos['id']; ?>' />
                    <div>
                        <label> Titre </label>
                        <input type='texte' name='titre' value='<?php echo $page_infos['titre']; ?>' />
                    </div>
                    <div>
                        <label> Description de la page </label>
                        <textarea rows="5" cols="30" name='description'> <?php echo $page_infos['description']; ?> </textarea>
                    </div>
                    <input type='submit' value='Modifier' name='modifierpage' />
                </form>
            <?php
            }
        }
    }


    // ----- catégorie ----- //

    public function admincat_modif($cat)
    {
        if (!empty($cat)) {
            foreach ($cat as $infos_cat) { ?>
                <form action='' method='POST' enctype="multipart/form-data">
                    <div>
                        <img src='<?php echo $infos_cat['img'] ?>' alt='img_cat' />
                        <input type="file" name="img" />
                    </div>
                    <input type='hidden' name='id' value='<?php echo $infos_cat['id']; ?>' />
                    <div>
                        <label> Nom de la catégorie </label>
                        <input type='texte' name='nom' value='<?php echo $infos_cat['nom']; ?>' />
                    </div>
                    <div>
                        <label> Description de la catégorie </label>
                        <textarea rows="5" cols="30" name='description'> <?php echo $infos_cat['description']; ?> </textarea>
                    </div>
                    <input type='submit' value='Modifier' name='modifiercat'/>
                    <a href="include/delete.php?idcat=<?php echo $infos_cat['id']; ?>">X</a>
                </form>
        <?php }
        }
    }

    public function admincat_ajout()
    { ?>

        <form action='' method='POST' enctype="multipart/form-data">
            <input type="file" name="img" />
            <div>
                <label> Nom de la catégorie </label>
                <input type='texte' name='nom' />
            </div>
            <div>
                <label> Description de la catégorie </label>
                <textarea rows="5" cols="30" name='description'> </textarea>
            </div>
            <input type="submit" name='ajoutercat' value='Ajouter'/>
        </form>
        <?php }

    // ----- sous-catégorie ----- //

    public function adminsouscat_modif($souscat, $cat)
    {
        if (!empty($souscat)) {
            foreach ($souscat as $infos_souscat) { ?>
                <form action='' method='POST' enctype="multipart/form-data">
                    <div>
                        <img src='<?php echo $infos_souscat['img'] ?>' alt='img_cat' />
                        <input type="file" name="img" />
                    </div>
                    <input type='hidden' name='id' value='<?php echo $infos_souscat['id']; ?>' />
                    <div>
                        <label> Nom de la categorie </label>
                        <select name='categorie'>
                            <?php foreach ($cat as $infos_cat) { ?>
                                <option value='<?php echo $infos_cat['nom']; ?>' <?php if ($infos_cat['id'] == $infos_souscat['id_categorie']) {
                                                                                        echo 'selected';
                                                                                    } ?>> <?php echo $infos_cat['nom']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label> Nom de la sous-catégorie </label>
                        <input type='texte' name='nom' value='<?php echo $infos_souscat['nom']; ?>' />
                    </div>
                    <div>
                        <label> Description de la sous-catégorie </label>
                        <textarea rows="5" cols="30" name='description'> <?php echo $infos_souscat['description']; ?> </textarea>
                    </div>
                    <input type='submit' value='Modifier' name='modifiersouscat'/>
                    <a href="include/delete.php?idsouscat=<?php echo $infos_souscat['id']; ?>">X</a>
                </form>
        <?php }
        }
    }

    public function adminsouscat_ajout($cat)
    { ?>
        <form action='' method='POST' enctype="multipart/form-data">
            <input type="file" name="img" />
            <div>
                <label> Catégorie </label>
                <select name='categorie'>
                    <?php foreach ($cat as $infos_cat) { ?>
                        <option> <?php echo $infos_cat['nom']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label> Nom de la sous-catégorie </label>
                <input type='texte' name='nom' />
            </div>
            <div>
                <label> Description de la sous-catégorie </label>
                <textarea rows="5" cols="30" name='description'> </textarea>
            </div>

            <input type="submit" name='ajoutersouscat' value='Ajouter'/>
        </form>
    <?php
    }

    // ----- produit ----- //

    public function adminproduit_ajout($souscat)
    { ?>
        <form action='' method='POST' enctype="multipart/form-data">
            <input type="file" name="img" />
            <div>
                <label> Nom de la sous-catégorie </label>
                <select name='sous_categorie'>
                    <?php foreach ($souscat as $infos_souscat) { ?>
                        <option><?php echo $infos_souscat['nom']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label> Nom du produit </label>
                <input type='text' name='nom' />
            </div>
            <div>
                <label> Prix du produit </label>
                <input type='number' name='prix' />
            </div>
            <div>
                <label> Description 1 </label>
                <textarea rows="5" cols="30" name='descriptionup'> </textarea>
            </div>
            <div>
                <label> Description 2 </label>
                <textarea rows="5" cols="30" name='descriptiondown'> </textarea>
            </div>
            <input type="submit" name='ajouterproduit' value='Ajouter'/>
        </form>
        <?php }

    public function adminproduit_modif($produit, $souscat)
    {
        if (!empty($produit)) {
            foreach ($produit as $infos_produit) { ?>
                <form action='' method='POST' enctype="multipart/form-data">
                    <div>
                        <img src='<?php echo $infos_produit['img'] ?>' alt='img_produit' />
                        <input type="file" name="img" />
                    </div>
                    <div>
                        <label> Nom de la sous_categorie </label>
                        <select name='sous_categorie'>
                            <?php foreach ($souscat as $infos_souscat) { ?>
                                <option value='<?php echo $infos_souscat['nom']; ?>' <?php if ($infos_souscat['id'] == $infos_produit['id_souscat']) {
                                                                                            echo 'selected';
                                                                                        } ?>> <?php echo $infos_souscat['nom']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label> Nom du produit </label>
                        <input type='texte' name='nom' value='<?php echo $infos_produit['nom']; ?>' />
                    </div>
                    <div>
                        <label> Prix du produit </label>
                        <input type='number' name='prix' value='<?php echo $infos_produit['prix']; ?>' />
                    </div>
                    <div>
                        <label> Description 1 </label>
                        <textarea rows="5" cols="30" name='descriptionup'> <?php echo $infos_produit['descriptionup']; ?> </textarea>
                    </div>
                    <div>
                        <label> Description 2 </label>
                        <textarea rows="5" cols="30" name='descriptiondown'> <?php echo $infos_produit['descriptiondown']; ?> </textarea>
                    </div>

                    <input type='hidden' name='id' value='<?php echo $infos_produit['id']; ?>' />

                    <input type='submit' value='Modifier' name='modifierproduit'/>
                    <a href="include/delete.php?idproduit=<?php echo $infos_produit['id']; ?>">X</a>
                </form>
            <?php }
        }
    }

    // ------------- Affichage user ---------------- //

    // ----- Liste des catégories ----- //

    public function affiche_cat($cat)
    {
        if (!empty($cat)) { ?>
            <h1> Nos catégories </h1>
        <?php } ?>
        <article>
            <?php
            foreach ($cat as $infos_cat) { ?>
                <div id='accueil'>
                    <a href='categorie.php?idcat=<?php echo $infos_cat['id']; ?>'>
                        <figure>
                            <img src='<?php echo $infos_cat['img']; ?>' alt='img_souscat' />
                            <figcaption> <?php echo $infos_cat['nom']; ?> </figcaption>
                        </figure>
                    </a>
                    <p> <?php echo $infos_cat['description']; ?> </p>
                </div>
            <?php
            } ?>
        </article>
        <?php
    }

    public function affiche_nouveaute($produit)
    {
        if (!empty($produit)) { ?>
            <h1> Nos nouveautés </h1>
        <?php } ?>
        <article>
            <?php
            foreach ($produit as $infos_produit) { ?>
                <div id='accueil'>
                    <a href='produit.php?id=<?php echo $infos_produit['id']; ?>'>
                        <figure>
                            <img src='<?php echo $infos_produit['img']; ?>' alt='img_souscat' />
                            <figcaption> <?php echo $infos_produit['nom']; ?> </figcaption>
                        </figure>
                    </a>
                </div>
            <?php
            } ?>
        </article>
        <?php
    }

    // ----- Liste des catégories ----- //

    // ----- catégorie ----- //

    public function usercat($produit, $souscat, $cat)
    {
        if (!empty($produit)) {
            foreach ($cat as $infos_cat) {
                if ($infos_cat['id'] == $_GET['idcat']) { ?>
                    <div id='titre'>
                        <span> <a href='boutique.php?idpage=1'> Boutique > </a> </span>
                        <h1> <?php echo $infos_cat['nom']; ?> </h1>
                    </div>
        <?php }
            }
        } ?>
        <article>
            <?php
            foreach ($produit as $infos_produit) {
                foreach ($souscat as $infos_souscat) {
                    if ($infos_produit['id_souscat'] == $infos_souscat['id']) {
                        if ($infos_souscat['id_categorie'] == $_GET['idcat']) { ?>
                            <div>
                                <img src='<?php echo $infos_produit['img']; ?>' alt='img_souscat' />
                                <p> <?php echo $infos_produit['nom']; ?></p>
                                <p> Prix : <?php echo $infos_produit['prix']; ?> €</p>
                                <a href='produit.php?id=<?php echo $infos_produit['id']; ?>'> Voir le produit</a>
                            </div>
            <?php }
                    }
                }
            } ?>
        </article>
        <?php
    }

    // ----- sous-catégorie ----- //

    public function usersouscat($produit, $souscat, $cat)
    {
        if (!empty($produit)) {
            foreach ($cat as $infos_cat) {
                foreach ($souscat as $infos_souscat) {
                    if ($infos_souscat['id'] == $_GET['idsouscat'] && $infos_cat['id'] == $infos_souscat['id_categorie']) { ?>
                        <div id='titre'>
                            <span><a href='boutique.php?idpage=1'> Boutique </a> > <a href='categorie.php?idcat=<?php echo $infos_souscat['id_categorie'] ?>'> <?php echo $infos_cat['nom'] . ' > '; ?> </a> </span>
                            <h1> <?php echo $infos_souscat['nom']; ?> </h1>
                        </div>
            <?php }
                }
            } ?>
            <article>
                <?php
                foreach ($produit as $infos_produit) {
                    if ($infos_produit['id_souscat'] == $_GET['idsouscat']) { ?>
                        <div>
                            <img src='<?php echo $infos_produit['img']; ?>' alt='img_souscat' />
                            <p> <?php echo $infos_produit['nom']; ?></p>
                            <p> <?php echo $infos_produit['prix']; ?>€</p>
                            <a href='produit.php?id=<?php echo $infos_produit['id']; ?>'> Voir le produit </a>
                        </div>
                <?php }
                } ?>
            </article>
        <?php }
    }

    // ----- liste produits ----- //

    public function userlisteproduit($produit)
    {
        if (!empty($produit)) { ?>
            <article>
                <?php
                foreach ($produit as $infos_produit) { ?>
                    <div>
                        <img src='<?php echo $infos_produit['img']; ?>' alt='img_souscat' />
                        <p> <?php echo $infos_produit['nom']; ?></p>
                        <p> <?php echo $infos_produit['prix']; ?>€</p>
                        <a href='produit.php?id=<?php echo $infos_produit['id']; ?>'> Voir le produit </a>
                    </div>
                <?php }
                ?>
            </article>
            <?php
        }
    }

    public function userlisteproduitrecherche($produitadmin, $resultats)
    {
        if (!empty($produitadmin)) {
            if (!empty($resultats)) { ?>
                <h1> Résultat de votre recherche </h1>
                <?php foreach ($produitadmin as $produits) {
                    foreach ($resultats as $resultat_recherche) {
                        if ($produits['nom'] == $resultat_recherche['nom']) { ?>
                            <article>
                                <img src='<?php echo $produits['img']; ?>' alt='img_souscat' />
                                <p> <?php echo $produits['nom']; ?></p>
                                <p> <?php echo $produits['prix']; ?></p>
                                <a href='produit.php?id=<?php echo $produits['id']; ?>'> en savoir plus </a>
                            </article>
<?php }
                    }
                }
            } else {
                $this->lastmessage =  'Aucun résultats pour cette recherche';
            }
        }
    }

    public function get($var)
    {
        return $this->$var;
    }
    /* Profil */

    public function historique($id){
        $request = "SELECT id,date,prix FROM achat WHERE id_user = $id";
        $query = mysqli_query($this->bdd,$request);
        $fecth = mysqli_fetch_all($query);
        if(!empty($fecth)){
            foreach($fecth as list($id,$date,$prix)){
                ?>
                <article>
                    <p>Achat du <?=$date ?> pour <?=$prix ?>€ veuillez cliquer <a href="historique.php?id=<?=$id ?>">ici</a> pour voir le détail.</p>
                </article>
                <?php
            }
        }
    }
    /* historique */

    public function historiquedetail($id){
        $request = "SELECT achat_product.quantite, product.nom, product.prix, product.img, achat.date FROM achat_product INNER JOIN product ON achat_product.id_produit = product.id INNER JOIN achat ON achat_product.id_achat = achat.id WHERE achat_product.id_achat = $id";
        $query = mysqli_query($this->bdd,$request);
        $fecth = mysqli_fetch_all($query);
        ?><article>
        <p>Achat du <?=$fecth[0][4] ?></p>
        <table class="blueTable">
        <thead>
            <tr>
                <td>Image</td>
                <td>Nom du jeu</td>
                <td>Prix</td>
                <td>quantité</td>
            </tr>
        </thead>
            <?php
            foreach($fecth as list($quantity,$name,$price,$img)){
                ?>
                <tr>
                    <td><img src="<?=$img ?>" class="imghisto"></td>
                    <td><?=$name ?></td>
                    <td><?=$price ?>€</td>
                    <td><?=$quantity ?></td>
                </tr><?php
            }
            ?>
        </table>
        
        </article>
        <?php
    }
}
?>