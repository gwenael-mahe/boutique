<?php

// include 'bdd.php';

class affichage{

    private $bdd;

    public function __construct()
    {
        $bdd = new bdd();
        $this->bdd = $bdd->getco();
    }
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
                        <input type="image" src="img/product/addtocart.png" name="add" value="submit" class="submitbutton">
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
                    <input type="text" name="com">
                    <input type="submit" value="envoyer" name="send">
                </form>
            </section>
        <?php
    }
    public function addcommentaire($iduser,$com,$idproduct){
        $request = "INSERT INTO commentaires(id_user,message,date,id_product) VALUES ($iduser,$com,NOW(),$idproduct)";
        $query = myslqi_query($this->bdd,$request);
    }
    public function commentaire($id){
        $request = "SELECT commentaires.message,commentaires.date,user.login FROM commentaires INNER JOIN user ON commentaires.id_user = user.id WHERE commentaires.id_product = $id";
        $query = mysqli_query($this->bdd,$request);
        $fetch = myslqi_fetch_assoc($query);
        if(!empty($fetch)){
            foreach($fetch as list($com,$date,$login)){
                ?>
                    <section>
                        <article>
                            <p><?php echo $login ?></p>
                            <p><?php echo $date ?></p>
                        </article>
                        <article>
                            <p><?php echo $com ?></p>
                        </article>
                    </section>
                <?php
            }
        }
        else
        return false;
    }
}

?>