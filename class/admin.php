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
        if ($newimg != NULL) {
            $query_majcategorie = mysqli_query($this->get('bdd')->getco(), "UPDATE categorie SET nom = '" . $majcat . "' , description = '" . $majdescription . "', img = '" . $newimg . "' WHERE id = '" . $idcat . "'");
        } else {
            $query_majcategorie = mysqli_query($this->get('bdd')->getco(), "UPDATE categorie SET nom = '" . $majcat . "' , description = '" . $majdescription . "' WHERE id = '" . $idcat . "'");
        }
    }

    public function deletecategorie($id_cat)
    {
        $id_cat = $_GET['idcat'];
        $query_deletecategorie = mysqli_query($this->get('bdd')->getco(), "DELETE FROM categorie WHERE id = '$id_cat'");
    }

    public function ajoutsouscategorie($newsouscat, $description, $cat, $img = '')
    {
        $recupidcat = mysqli_query($this->get('bdd')->getco(), "SELECT id FROM categorie WHERE nom = '".$cat."'");
        $idcat = mysqli_fetch_row($recupidcat);

        if ($img != NULL) {
            $query_ajoutsouscategorie = mysqli_query($this->get('bdd')->getco(), "INSERT INTO sous_categorie (nom,description,img,id_categorie) VALUE ('" . $newsouscat . "','" . $description . "','" . $img . "','" . $idcat[0] . "')");
        } else {
            $query_ajoutsouscategorie = mysqli_query($this->get('bdd')->getco(), "INSERT INTO sous_categorie (nom,description,id_categorie) VALUE ('" . $newsouscat . "','" . $description . "','" . $idcat[0] . "')");
        }
    }

    public function majsouscategorie($majsouscat, $majdescription, $cat, $newimg, $idsouscat)
    {
        $recupidcat = mysqli_query($this->get('bdd')->getco(), "SELECT id FROM categorie WHERE nom = '".$cat."'");
        $idcat = mysqli_fetch_row($recupidcat);

        if ($newimg != NULL) {
            $query_majsouscategorie = mysqli_query($this->get('bdd')->getco(), "UPDATE sous_categorie SET nom = '" . $majsouscat . "' , description = '" . $majdescription . "', img = '" . $newimg . "' WHERE id = '" . $idsouscat . "'");
        } else {
            $query_majsouscategorie = mysqli_query($this->get('bdd')->getco(), "UPDATE sous_categorie SET nom = '" . $majsouscat . "' , description = '" . $majdescription . "', id_categorie = '" . $idcat[0] . "' WHERE id = '" . $idsouscat . "'");
        }
    }

    public function deletesouscategorie($id_souscat)
    {
        $query_deletesouscategorie = mysqli_query($this->get('bdd')->getco(), "DELETE FROM sous_categorie WHERE id = '$id_souscat'");
    }

    public function traitementimg($nom)
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
