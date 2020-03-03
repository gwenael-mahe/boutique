<?php

class bdd{

    private $connexion;
    private $categorie;
    private $souscategorie;

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
        $query_categorie = mysqli_query($this->connexion, "SELECT id,nom,description,img FROM categorie");
        $result_categorie = mysqli_fetch_all($query_categorie,MYSQLI_ASSOC);
        $this->categorie = $result_categorie;
    }

    public function checksouscategorie()
    {
        $query_souscategorie = mysqli_query($this->connexion, "SELECT id,nom,description,img,id_categorie FROM sous_categorie");
        $result_souscategorie = mysqli_fetch_all($query_souscategorie,MYSQLI_ASSOC);
        $this->souscategorie = $result_souscategorie;
    }

    public function get($var)
    {
        return $this->$var;
    }
}