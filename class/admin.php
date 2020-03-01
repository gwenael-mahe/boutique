<?php

class admin
{
    // Déclaration des attributs

    private $bdd;
    private $filesimg;

    // Déclaration des méthodes

    public function __construct()
    {
        $bdd = new bdd();
        $this->bdd = $bdd;
    }

    public function ajoutcategorie($newcat, $description, $img = '')
    {
        if ($img != NULL) {
            $query_ajoutcategorie = mysqli_query($this->get('bdd')->getco(), "INSERT INTO categorie (nom,description,img) VALUE ('" . $newcat . "','" . $description . "','" . $img . "')");
        } else {
            $query_ajoutcategorie = mysqli_query($this->get('bdd')->getco(), "INSERT INTO categorie (nom,description) VALUE ('" . $newcat . "','" . $description . "')");
        }
    }

    public function majcategorie($majcat, $majdescription, $newimg, $idcat)
    {
        $query_majlieu = mysqli_query($this->get('bdd')->getco(), "UPDATE categorie SET nom = '".$majcat."' , description = '".$majdescription."', img = '".$newimg."' WHERE id = '".$idcat."'");
    }

    public function deletecategorie($id_cat)
    {
        $id_cat = $_GET['idcat'];
        $query_deletelieu = mysqli_query($this->get('bdd')->getco(), "DELETE FROM categorie WHERE id = '$id_cat'");
    }

    public function traitementimg($nom, $id = '')
    {
        if (!empty($_FILES["img"]["name"])) {
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo(basename($_FILES["img"]["name"]), PATHINFO_EXTENSION));
            $target_dir = "img/cat/";
            $target_file = $target_dir . $nom . '.' . $imageFileType;
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $uploadOk = 0;
            }
            if ($uploadOk == 1 && move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                $this->filesimg = $target_file;
            }
        }
    }

    public function get($var)
    {
        return $this->$var;
    }
}
