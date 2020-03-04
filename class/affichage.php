<?php

class affichage
{

    private $admin;

    public function __construct()
    {
        $admin = new admin();
        $this->admin = $admin;
    }

    // --------- Header --------- //

    public function header($id)
    {
        $request = "SELECT titre,description,img FROM basicpage WHERE id_page = $id";
        $query = mysqli_query($this->admin->get('bdd')->getco(), $request);
        $fetch = mysqli_fetch_assoc($query); ?>

        <section>

            <aside> <img src='<?php echo $fetch['img']; ?>'> </aside>

            <article>
                <h1> <?php echo $fetch['titre']; ?></h1>
                <p> <?php echo $fetch['description']; ?></p>
            </article>

        </section>
        <?php
    }

    // ------------- Affichage admin ---------------- //

    public function admincat($variable)
    {
        if (!empty($variable)) {
            foreach ($variable as $infos_cat) { ?>
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
                    <input type='submit' value='Modifier' name='modifiercat' />
                    <a href="include/delete.php?idcat=<?php echo $infos_cat['id']; ?>">X</a>
                </form>
        <?php }
        } ?>

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
            <input type="submit" name='ajoutercat' value='Ajouter' />
        </form>
        <?php }

    public function adminsouscat($souscat, $cat)
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
                    <input type='submit' value='Modifier' name='modifiersouscat' />
                    <a href="include/delete.php?idsouscat=<?php echo $infos_souscat['id']; ?>">X</a>
                </form>
        <?php }
        } ?>

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

            <input type="submit" name='ajoutersouscat' value='Ajouter' />
        </form>
    <?php }

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
            <input type="submit" name='ajouterproduit' value='Ajouter' />
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

                    <input type='submit' value='Modifier' name='modifierproduit' />
                    <a href="include/delete.php?idproduit=<?php echo $infos_produit['id']; ?>">X</a>
                </form>
            <?php }
        }
    }

    // ------------- Affichage user ---------------- //

    public function usercat($cat)
    {
        if (!empty($cat)) {
            foreach ($cat as $infos_cat) { ?>
                <article>
                    <img src='<?php echo $infos_cat['img']; ?>' alt='img_cat' />
                    <p> <?php echo $infos_cat['nom']; ?></p>
                    <p> <?php echo $infos_cat['description']; ?></p>
                </article>
            <?php }
        }
    }

    public function usersouscat($souscat)
    {
        if (!empty($souscat)) {
            foreach ($souscat as $infos_souscat) { ?>
                <article>
                    <img src='<?php echo $infos_souscat['img']; ?>' alt='img_souscat' />
                    <p> <?php echo $infos_souscat['nom']; ?></p>
                    <p> <?php echo $infos_souscat['description']; ?></p>
                </article>
            <?php }
        }
    }

    public function userproduit($produit)
    {
        if (!empty($produit)) {
            foreach ($produit as $infos_produit) { ?>
                <article>
                    <img src='<?php echo $infos_produit['img']; ?>' alt='img_souscat' />
                    <p> <?php echo $infos_produit['nom']; ?></p>
                    <p> <?php echo $infos_produit['prix']; ?></p>
                    <a href='produit.php?idproduit=<?php echo $infos_produit['id']; ?>'> en savoir plus </a>
                </article>
<?php }
        }
    }


    public function get($var)
    {
        return $this->$var;
    }
}
