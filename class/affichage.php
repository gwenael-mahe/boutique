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

    public function admincat()
    {
        $this->admin->get('bdd')->checkcategorie();
        foreach ($this->admin->get('bdd')->get('categorie') as $infos_cat) {
        ?>
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
                    <textarea rows="5" cols="33" name='description'> <?php echo $infos_cat['description']; ?> </textarea>
                </div>
                <input type='submit' value='Modifier' name='modifier_cat' />
                <a href="include/delete.php?idcat=<?php echo $infos_cat['id']; ?>">X</a>
            </form>
        <?php } ?>

        <form action='' method='POST' enctype="multipart/form-data">
            <input type="file" name="img" />
            <div>
                <label> Nom de la catégorie </label>
                <input type='texte' name='nom' />

            </div>
            <div>
                <label> Description de la catégorie </label>

                <textarea rows="5" cols="33" name='description'> </textarea>
            </div>
            <input type="submit" name='ajoutcat' value='Ajouter' />
        </form>
<?php }

    public function get($var)
    {
        return $this->$var;
    }
}
