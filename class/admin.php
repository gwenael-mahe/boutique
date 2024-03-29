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

    // Méthode modif page

    public function majpage($majtitre, $majdescription)
    {
        $recupidpage = mysqli_query($this->get('bdd')->getco(), "SELECT id FROM basicpage WHERE id_page = 1");
        $idpage = mysqli_fetch_row($recupidpage);

        $this->traitementimgpage($idpage[0]);

        if ($this->filesimg != NULL) {
            $query_majpage = mysqli_query($this->get('bdd')->getco(), "UPDATE basicpage SET titre = '" . $majtitre . "' , description = '" . $majdescription . "',img = '" . $this->filesimg . "' WHERE id = '" . $idpage[0]. "'");
        } else {
            $query_majpage = mysqli_query($this->get('bdd')->getco(), "UPDATE basicpage SET titre = '" . $majtitre . "' , description = '" . $majdescription . "' WHERE id = '" . $idpage[0] . "'");
        }
    }

    public function traitementimgpage($id)
    {
        if (!empty($_FILES["img"]["name"])) {
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo(basename($_FILES["img"]["name"]), PATHINFO_EXTENSION));
            $target_dir = "img/logo/";
            $target_file = $target_dir . $id . '.' . $imageFileType;
            foreach (scandir($target_dir) as $files) {
                if (pathinfo(basename($files), PATHINFO_FILENAME) == $id) {
                    unlink($target_dir . $files);
                }
            }
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

    // Méthode ajout catégorie 

    public function ajoutcategorie($newcat, $description)
    {
        $query_ajoutcategorie = mysqli_query($this->get('bdd')->getco(), "INSERT INTO categorie (nom,description) VALUE ('" . $newcat . "','" . $description . "')");
        $this->bdd->checkcategorie();

        foreach ($this->bdd->get('categorie') as $cat) {
            if ($cat['nom'] == $newcat) {
                $idnewcat = $cat['id'];
            }
        }

        $this->traitementimgcat($idnewcat);

        if ($this->filesimg != NULL) {
            $query_ajoutcategorie_img = mysqli_query($this->get('bdd')->getco(), "UPDATE categorie SET img = '" . $this->filesimg . "' WHERE id = '" . $idnewcat . "'");
        }
    }

    public function majcategorie($majcat, $majdescription, $idcat)
    {

        $this->traitementimgcat($idcat);

        if ($this->filesimg != NULL) {
            $query_majcategorie = mysqli_query($this->get('bdd')->getco(), "UPDATE categorie SET nom = '" . $majcat . "' , description = '" . $majdescription . "', img = '" . $this->filesimg . "' WHERE id = '" . $idcat . "'");
        } else {
            $query_majcategorie = mysqli_query($this->get('bdd')->getco(), "UPDATE categorie SET nom = '" . $majcat . "' , description = '" . $majdescription . "' WHERE id = '" . $idcat . "'");
        }
    }

    public function deletecategorie($id_cat)
    {
        $id_cat = $_GET['idcat'];
        $recup_img_delete = mysqli_query($this->get('bdd')->getco(), "SELECT img FROM categorie WHERE id = '$id_cat'");
        $result_img = mysqli_fetch_assoc($recup_img_delete);

        if (basename($result_img['img']) != 'default.png') {
            unlink('../' . $result_img['img']);
        }

        $query_deletecategorie = mysqli_query($this->get('bdd')->getco(), "DELETE FROM categorie WHERE id = '$id_cat'");
    }

    public function traitementimgcat($id)
    {
        if (!empty($_FILES["img"]["name"])) {
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo(basename($_FILES["img"]["name"]), PATHINFO_EXTENSION));
            $target_dir = "img/cat/";
            $target_file = $target_dir . $id . '.' . $imageFileType;
            foreach (scandir($target_dir) as $files) {
                if (pathinfo(basename($files), PATHINFO_FILENAME) == $id) {
                    unlink($target_dir . $files);
                }
            }
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

    // Méthode ajout sous_catégorie 

    public function ajoutsouscategorie($newsouscat, $description, $cat)
    {
        $recupidcat = mysqli_query($this->get('bdd')->getco(), "SELECT id FROM categorie WHERE nom = '" . $cat . "'");
        $idcat = mysqli_fetch_row($recupidcat);

        $query_ajoutsouscategorie = mysqli_query($this->get('bdd')->getco(), "INSERT INTO sous_categorie (nom,description,id_categorie) VALUE ('" . $newsouscat . "','" . $description . "','" . $idcat[0] . "')");
        $this->bdd->checksouscategorie();

        foreach ($this->bdd->get('souscategorie') as $souscat) {
            if ($souscat['nom'] == $newsouscat) {
                $idnewsouscat = $souscat['id'];
                echo $idnewsouscat;
            }
        }

        $this->traitementimgsouscat($idnewsouscat);

        if ($this->filesimg != NULL) {
            $query_ajoutsouscategorie_img = mysqli_query($this->get('bdd')->getco(), "UPDATE sous_categorie SET img = '" . $this->filesimg . "' WHERE id = '" . $idnewsouscat . "'");
        }
    }

    public function majsouscategorie($majsouscat, $majdescription, $idcat, $idsouscat)
    {
        $recupidcat = mysqli_query($this->get('bdd')->getco(), "SELECT id FROM categorie WHERE nom = '" . $idcat . "'");
        $idcat = mysqli_fetch_row($recupidcat);

        $this->traitementimgsouscat($idsouscat);

        if ($this->filesimg != NULL) {
            $query_majsouscategorie = mysqli_query($this->get('bdd')->getco(), "UPDATE sous_categorie SET nom = '" . $majsouscat . "' , description = '" . $majdescription . "', id_categorie = '" . $idcat[0] . "',img = '" . $this->filesimg . "' WHERE id = '" . $idsouscat . "'");
        } else {
            $query_majsouscategorie = mysqli_query($this->get('bdd')->getco(), "UPDATE sous_categorie SET nom = '" . $majsouscat . "' , description = '" . $majdescription . "',id_categorie = '" . $idcat[0] . "' WHERE id = '" . $idsouscat . "'");
        }
    }

    public function deletesouscategorie($id_souscat)
    {
        $id_souscat = $_GET['idsouscat'];
        $recup_img_delete = mysqli_query($this->get('bdd')->getco(), "SELECT img FROM sous_categorie WHERE id = '$id_souscat'");
        $result_img = mysqli_fetch_assoc($recup_img_delete);
        unlink('../' . $result_img['img']);

        if (basename($result_img['img']) != 'default.png') {
            unlink('../' . $result_img['img']);
        }

        $query_deletesouscategorie = mysqli_query($this->get('bdd')->getco(), "DELETE FROM sous_categorie WHERE id = '$id_souscat'");
    }

    public function traitementimgsouscat($id)
    {
        if (!empty($_FILES["img"]["name"])) {
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo(basename($_FILES["img"]["name"]), PATHINFO_EXTENSION));
            $target_dir = "img/sous_cat/";
            $target_file = $target_dir . $id . '.' . $imageFileType;
            foreach (scandir($target_dir) as $files) {
                if (pathinfo(basename($files), PATHINFO_FILENAME) == $id) {
                    unlink($target_dir . $files);
                }
            }
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

    // Méthode ajout produit

    public function ajoutproduit($newproduit, $prix, $descriptionup, $descriptiondown, $souscat)
    {
        $recupidsouscat = mysqli_query($this->get('bdd')->getco(), "SELECT id FROM sous_categorie WHERE nom = '" . $souscat . "'");
        $idsouscat = mysqli_fetch_row($recupidsouscat);

        var_dump($idsouscat);

        $query_ajoutproduit = mysqli_query($this->get('bdd')->getco(), "INSERT INTO product (nom,prix,descriptionup,descriptiondown,id_souscat) VALUE ('" . $newproduit . "','" . $prix . "','" . $descriptionup . "','" . $descriptiondown . "','" . $idsouscat[0] . "')");
        $this->bdd->checkproduitadmin();

        foreach ($this->bdd->get('produitadmin') as $produit) {
            if ($produit['nom'] == $newproduit) {
                $idnewproduit = $produit['id'];
                echo $idnewproduit;
            }
        }

        $this->traitementimgproduit($idnewproduit);

        if ($this->filesimg != NULL) {
            $query_ajoutproduit_img = mysqli_query($this->get('bdd')->getco(), "UPDATE product SET img = '" . $this->filesimg . "' WHERE id = '" . $idnewproduit . "'");
        }
    }

    public function majproduit($majproduit, $majprix, $majdescriptionup, $majdescriptiondown, $souscat, $idproduit)
    {
        $recupidcat = mysqli_query($this->get('bdd')->getco(), "SELECT id FROM sous_categorie WHERE nom = '" . $souscat . "'");
        $idsouscat = mysqli_fetch_row($recupidcat);

        $this->traitementimgproduit($idproduit);

        if ($this->filesimg != NULL) {
            $query_majproduit = mysqli_query($this->get('bdd')->getco(), "UPDATE product SET nom = '" . $majproduit . "' , prix = '" . $majprix . "', descriptionup = '" . $majdescriptionup . "', descriptiondown = '" . $majdescriptiondown . "', id_souscat = '" . $idsouscat[0] . "',img = '" . $this->filesimg . "' WHERE id = '" . $idproduit . "'");
        } else {
            $query_majproduit = mysqli_query($this->get('bdd')->getco(), "UPDATE product SET nom = '" . $majproduit . "' , prix = '" . $majprix . "', descriptionup = '" . $majdescriptionup . "', descriptiondown = '" . $majdescriptiondown . "', id_souscat = '" . $idsouscat[0] . "' WHERE id = '" . $idproduit . "'");
        }
    }

    public function deleteproduit($id_produit)
    {
        $id_produit = $_GET['idproduit'];
        $recup_img_delete = mysqli_query($this->get('bdd')->getco(), "SELECT img FROM product WHERE id = '$id_produit'");
        $result_img = mysqli_fetch_assoc($recup_img_delete);
        unlink('../' . $result_img['img']);

        if (basename($result_img['img']) != 'default.png') {
            unlink('../' . $result_img['img']);
        }

        $query_deleteproduit = mysqli_query($this->get('bdd')->getco(), "DELETE FROM product WHERE id = '$id_produit'");
    }

    public function traitementimgproduit($id)
    {
        if (!empty($_FILES["img"]["name"])) {
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo(basename($_FILES["img"]["name"]), PATHINFO_EXTENSION));
            $target_dir = "img/product/";
            $target_file = $target_dir . $id . '.' . $imageFileType;
            foreach (scandir($target_dir) as $files) {
                if (pathinfo(basename($files), PATHINFO_FILENAME) == $id) {
                    unlink($target_dir . $files);
                }
            }
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
