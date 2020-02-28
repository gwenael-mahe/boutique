<?php

include 'bdd.php';

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
}
?>