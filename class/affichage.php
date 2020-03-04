<?php

class affichage{

    private $bdd;

    public function __construct()
    {
        $bdd = new bdd();
        $this->bdd = $bdd->getco();
    }
    //-------------------- page produit --------------------//
    public function product($id){
        $request = "SELECT id,nom,prix,descriptionup,descriptiondown,img FROM product WHERE id = $id";
        $query = mysqli_query($this->bdd,$request);
        $fetch = mysqli_fetch_assoc($query);
        // var_dump($fetch);
        if(!empty($fetch)){
            ?>
                <section>
                    <article>
                        <img src="<?php echo $fetch['img'] ?>" class="imgproduct">
                        <p><?php echo $fetch['descriptionup'] ?></p>
                    </article>
                    <article>
                        <p><?php echo $fetch['descriptiondown'] ?></p>
                        <p><?php echo $fetch['prix'] ?></p>
                    </article>
                    <form action="" method="post">
                        <input type="number" name="quantity">
                        <input type="hidden" name="<?php echo $fetch['id'] ?>">
                        <input type="image" src="img/product/addtocart.png" name="add" value="submit" class="submitimg">
                    </form>
                </section>
            <?php
        }
        else
        return false;
    }
    public function formmessage(){
        ?>
            <section>
                <form action="">
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
        $request = "INSERT INTO commentaires(id_user,message,date,id_product) VALUES ($iduser,'$com',NOW(),$idproduct)";
        $query = mysqli_query($this->bdd,$request);
        $requestavis = "INSERT INTO `avis`(`id_user`, `id_produit`, `id_message`, `notation`) VALUES ($iduser,$idproduct,LAST_INSERT_ID(),$avis)";
        $queryavis = mysqli_query($this->bdd,$requestavis);
    }
    public function notation($id){
        $request = "SELECT AVG(notation) FROM avis WHERE id_produit = $id";
        $query = mysqli_query($this->bdd,$request);
        $fetch = mysqli_fetch_all($query);
        var_dump($fetch);
        if(!empty($fetch)){
            ?>
                <section><p><?=$fetch[0][0] ?></p><img src="img/product/etoile.png" class="etoile"></section>
            <?php
        }
    }
    public function commentaire($id){
        $request = "SELECT commentaires.message,commentaires.date,user.login,avis.notation FROM commentaires INNER JOIN user ON commentaires.id_user = user.id INNER JOIN avis ON commentaires.id = avis.id_message WHERE commentaires.id_product = $id";
        $query = mysqli_query($this->bdd,$request);
        $fetch = mysqli_fetch_all($query);
        if(!empty($fetch)){
            foreach($fetch as list($com,$date,$login,$avis)){
                ?>
                    <section>
                        <article>
                            <p>Par <?php echo $login?></p>
                            <p>Le <?php echo $date ?></p>
                        </article>
                        <article>
                            <p><?php echo $avis ?><img src="img/product/etoile.png" class="etoile"></p>
                            <p><?php echo $com ?></p>
                        </article>
                    </section>
                <?php
            }
        }
        else
        return false;
    }
    //-------------------- page panier --------------------//
    public function panier($iduser){
        $request = "SELECT product.img,product.nom,product.prix,panier.quantite,panier.id FROM panier INNER JOIN product ON panier.id_product = product.id WHERE panier.id_user = $iduser";
        $query = mysqli_query($this->bdd,$request);
        $fetch = mysqli_fetch_all($query);
        if(!empty($fetch)){
            ?>
            <section>
                <table id="tablepanier">
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
            foreach($fetch as list($img,$nom,$prix,$quantity,$id)){
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
        }
        else
        return false;
    }
}

?>