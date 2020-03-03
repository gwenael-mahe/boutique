<?php

class bdd{

    private $connexion;
    private $categorie;
    private $souscategorie;
    private $produit;

    public function __construct()
    {
        if (!empty($this->connexion)) {
            mysqli_close($this->connexion);
        }
        $connexion = mysqli_connect('localhost', 'root', '', 'boutique');
        if ($connexion == false) {
            return false;
        } else {
            $this->connexion = $connexion;
        }

        $this->checkcategorie();
        $this->checksouscategorie();
        $this->checkproduit();
    }
    
    public function close(){
        mysqli_close($this->connexion);
    }

    public function getco()
    {
        return $this->connexion;
    }

    public function checkcategorie()
    {
        $query_categorie = mysqli_query($this->connexion, "SELECT * FROM categorie");
        $result_categorie = mysqli_fetch_all($query_categorie,MYSQLI_ASSOC);
        $this->categorie = $result_categorie;
    }

    public function checksouscategorie()
    {
        $query_souscategorie = mysqli_query($this->connexion, "SELECT * FROM sous_categorie");
        $result_souscategorie = mysqli_fetch_all($query_souscategorie,MYSQLI_ASSOC);
        $this->souscategorie = $result_souscategorie;
    }

    public function checkproduit()
    {
        $query_produit = mysqli_query($this->connexion, "SELECT * FROM product");
        $result_produit = mysqli_fetch_all($query_produit,MYSQLI_ASSOC);
        $this->produit = $result_produit;
    }


    public function get($var)
    {
        return $this->$var;
    }
}