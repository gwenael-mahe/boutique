<?php

class achat
{

    private $bdd;

    public function __construct()
    {
        $bdd = new bdd();
        $this->bdd = $bdd->getco();
    }
    public function addtocart($id,$iduser,$quantity){
        $request = "INSERT INTO panier(id_product,id_user,quantite) VALUES ($id,$iduser,$quantity)";
        $query = mysqli_query($this->bdd,$request);
    }
    public function removefromcart($id){
        $request = "DELETE FROM panier WHERE id = $id";
        $query = mysqli_query($this->bdd,$request);
    }
    public function countarticle($iduser){
        $request = "SELECT COUNT(id) FROM panier WHERE id_user = $iduser";
        $query = mysqli_quey($request);
        $fetch = mysqli_fetch_all($query);
        return $fetch[0][0];
    }
    public function pricecalculation($id){
        $request = "SELECT SUM((product.prix*panier.quantite)) FROM product INNER JOIN panier ON product.id = panier.id_product WHERE panier.id_user = $id";
        $query = mysqli_query($this->bdd,$request);
        $fetch = mysqli_fetch_all($query);
        return $fetch[0][0];
    }
    public function sendmail($iduser,$idachat){
        $request = "SELECT user.mail,achat.prix,achat.date FROM user INNER JOIN achat ON user.id = achat.id_user WHERE achat.id = $idachat";
        $query = mysqli_query($this->bdd,$request);
        var_dump($query);
        $fetch = mysqli_fetch_assoc($query);
        $to = $fetch['mail'];
        $subject = "Résumé de commande sur Boutique.com";
        $body = "Vous avez commandé sur notre site le ".$fetch['date'].". </br> Votre commande vous a couté ".$fetch['prix'].". <br/> Pour toutes information supplémentaire veuillez vous rendre sur votre profil. </br> Nous vous remercions de votre confiance et espérons vous revoir bientôt.";
        $header = "From: noreply@boutique.com\n";	
  
        mail($to, $subject, $body, $header);
    }
    public function addtohistory($id,$prix){
        $request = "INSERT INTO achat(id_user,prix,date) VALUES($id,$prix,NOW())";
        $query = mysqli_query($this->bdd,$request);
        $request = "SELECT LAST_INSERT_ID() FROM achat";
        $query = mysqli_query($this->bdd,$request);
        $fetch = mysqli_fetch_all($query);
        $idachat = $fetch[0][0];
        $request = "SELECT id_product,quantite FROM panier WHERE id_user = $id";
        $query = mysqli_query($this->bdd,$request);
        $fetch = mysqli_fetch_all($query);
        foreach($fetch as list($idproduct,$quantity)){
            $request = "INSERT INTO achat_product(id_achat,id_produit,quantite) VALUES($idachat,$idproduct,$quantity)";
            //var_dump($request);
            $query = mysqli_query($this->bdd,$request);
            //var_dump($query);
        }
        //$this->sendmail($id,$idachat);
    }
    public function resetcart($iduser){
        $request = "DELETE FROM panier WHERE id_user = $iduser";
        $query = mysqli_query($this->bdd,$request);
    }
}
    
    

?>