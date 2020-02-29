<?php

class admin
{
    // Déclaration des attributs

    private $bdd;

    // Déclaration des méthodes

    public function __construct()
    {
        $bdd = new bdd();
        $this->bdd = $bdd;
    }

    public function ajoutcategorie($newcat, $description, $img)
    {
        $query_ajoutcategorie = mysqli_query($this->get('bdd')->getco(), "INSERT INTO categorie (nom,description,img) VALUE ('$newcat','$description','$img')");
    }

    public function majcategorie($majcat, $majdescription, $newimg, $idcat)
    {
        $query_majlieu = mysqli_query($this->get('bdd')->getco(), "UPDATE categorie SET nom = '$majcat' , description = '$majdescription', img = '$newimg' WHERE id = $idcat");
    }

    public function deletecategorie($id_cat)
    {
        // $id_cat = $_GET['cat']; Décommenter en vrai situation
        $query_deletelieu = mysqli_query($this->connexion, "DELETE FROM categorie WHERE id = '$id_cat'");
    }

    // Doublon avec l'autre class...
    public function get($var)
    {
        return $this->$var;
    }
}