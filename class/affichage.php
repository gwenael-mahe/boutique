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
        $fetch = mysqli_fetch_assoc($query);
        // var_dump($fetch); 
?>

        <section>

            <aside> <img src='<?php echo $fetch['img']; ?>'> </aside>

            <article>
                <h1> <?php echo $fetch['titre']; ?></h1>
                <p> <?php echo $fetch['description']; ?></p>
            </article>

        </section>
        <?php
    }

    public function admincat($variable)
    {
        // $this->admin->get('bdd')->checkcategorie();
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
                <label> Nom de la sous-catégorie </label>
                <input type='texte' name='nom' />
            </div>
            <div>
                <label> Description de la sous-catégorie </label>
                <textarea rows="5" cols="30" name='description'> </textarea>
            </div>
            <div>
                <label> Catégorie </label>
                <select name='categorie'>
                    <?php foreach ($cat as $infos_cat) { ?>
                        <option> <?php echo $infos_cat['nom']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="submit" name='ajoutersouscat' value='Ajouter' />
        </form>
<?php }

    public function get($var)
    {
        return $this->$var;
    }
}
