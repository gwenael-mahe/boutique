<?php

class affichage
{

    private $bdd;

    public function __construct()
    {
        $bdd = new bdd();
        $this->bdd = $bdd->getco();
    }

    // --------- Header --------- //

    public function header($id)
    {
        $request = "SELECT titre,description,img FROM basicpage WHERE id_page = $id";
        $query = mysqli_query($this->bdd, $request);
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
}