<?php

class bdd
{

    private $connexion;
    private $categorie;
    private $souscategorie;
    private $produit;
    private $produitadmin;
    private $nombreDePages;
    private $page;
    private $recherche_produit;

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
        $this->checkproduitadmin();
        if (isset($_GET['idpage'])) {
            $this->checkproduit(5, $_GET['idpage']);
        }
    }

    public function close()
    {
        mysqli_close($this->connexion);
    }

    public function getco()
    {
        return $this->connexion;
    }

    public function checkcategorie()
    {
        $query_categorie = mysqli_query($this->connexion, "SELECT * FROM categorie");
        $result_categorie = mysqli_fetch_all($query_categorie, MYSQLI_ASSOC);
        $this->categorie = $result_categorie;
    }

    public function checksouscategorie()
    {
        $query_souscategorie = mysqli_query($this->connexion, "SELECT * FROM sous_categorie");
        $result_souscategorie = mysqli_fetch_all($query_souscategorie, MYSQLI_ASSOC);
        $this->souscategorie = $result_souscategorie;
    }

    public function checkproduitadmin()
    {
        $query_produitadmin = mysqli_query($this->connexion, "SELECT * FROM product");
        $result_produitadmin = mysqli_fetch_all($query_produitadmin, MYSQLI_ASSOC);
        $this->produitadmin = $result_produitadmin;
    }

    public function checkproduit($nbproduit, $idpage)
    {
        $offset = ($idpage - 1) * $nbproduit;
        $query_produit = mysqli_query($this->connexion, "SELECT SQL_CALC_FOUND_ROWS * FROM product LIMIT $nbproduit OFFSET $offset");
        $resultFoundRows = mysqli_query($this->connexion, "SELECT found_rows()");
        $nombredElementsTotal = mysqli_fetch_row($resultFoundRows);
        echo $nombredElementsTotal[0];
        $result_produit = mysqli_fetch_all($query_produit, MYSQLI_ASSOC);
        $nombreDePages = ceil($nombredElementsTotal[0] / $nbproduit);
        $this->nombreDePages = $nombreDePages;
        $this->produit = $result_produit;
        $this->page = $idpage;
    }

    public function resultatrecherche($recherche)
    {
        $query_produit_recherche = mysqli_query($this->connexion, "SELECT nom FROM product WHERE CONCAT(nom,descriptionup,descriptiondown) LIKE '%".$recherche."%' ORDER BY id DESC");
        $result_produit_recherche = mysqli_fetch_all($query_produit_recherche,MYSQLI_ASSOC);
        $this->recherche_produit = $result_produit_recherche;
        return $this->recherche_produit;
        ?>

    <?php }

    public function get($var)
    {
        return $this->$var;
    }
}
