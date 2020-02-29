<?php

class bdd{

    private $connexion;
    private $nomcategorie;
    private $lienimgcategorie;
    private $idcategorie;

    public function __construct()
    {
        if (!empty($this->connexion)) {
            mysqli_close($this->connexion);
        }
        $connexion = mysqli_connect('localhost', 'root', '', 'rncp');
        if ($connexion == false) {
            return false;
        } else {
            $this->connexion = $connexion;
        }

        $this->checkcategorie();
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
        $result_categorie = mysqli_fetch_all($query_categorie);
        foreach ($result_categorie as $checkcategorie) {
            $this->nomcategorie[$checkcategorie[1]] = $checkcategorie[2];
            $this->lienimgcategorie[$checkcategorie[1]] = $checkcategorie[3];
            $this->idcategorie[$checkcategorie[1]] = $checkcategorie[0];
        }
    }
}