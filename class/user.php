<?php

include 'bdd.php';

class user
{

    private $bdd;

    private $id;
    private $login;
    private $mail;

    public function __construct()
    {
        $this->bdd = new bdd();
        $this->bdd = $this->bdd->getco();
    }

    public function inscription($login, $mdp, $confmdp, $mail)
    {
        if ($login != NULL && $mdp != NULL && $confmdp != NULL && $mail != NULL) {
            if ($mdp == $confmdp) {
                $requete = "SELECT login,mail FROM user WHERE login = '$login' OR mail = '$mail'";
                $query = mysqli_query($this->bdd, $requete);
                $result = mysqli_fetch_all($query);
                if (empty($result)) {
                    $mdp = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 12));
                    $requete = "INSERT INTO user (login, password, mail) VALUES ('$login','$mdp','$mail')";
                    $query = mysqli_query($this->bdd, $requete);
                    header('location:connexion.php');
                } else {
                    return "log";
                }
            } else {
                return "mdp";
            }
        } else {
            return "empty";
        }
    }

    public function connexion($login, $mdp)
    {
        $requete = "SELECT * FROM user WHERE login = '$login'";
        $query = mysqli_query($this->bdd, $requete);
        $result = mysqli_fetch_assoc($query);
        if (!empty($result)) 
        {
            if ($login == $result["login"]) 
            {
                if (password_verify($mdp, $result["password"])) 
                {
                    $this->id = $result["id"];
                    $this->login = $result["login"];
                    $this->mail = $result["mail"];
                    // $_SESSION['login'] = $this->login; // A décommenter 
                    header('location:profil.php');
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

//     public function profil($confmdp, $login = "", $prenom = "", $nom = "", $mail = "", $mdp = "")
//     {
//         $this->bdd->connect();
//         $request = "SELECT mdp FROM utilisateurs WHERE id = " . $this->id . "";
//         //var_dump($request);
//         $query = mysqli_query($this->connexion, $request);
//         $fetchmdp = mysqli_fetch_assoc($query);
//         if (password_verify($confmdp, $fetchmdp["mdp"])) {
//             if ($login != NULL) {
//                 $request = "SELECT login FROM utilisateurs WHERE login = '$login'";
//                 $query = mysqli_query($this->connexion, $request);
//                 $result = mysqli_fetch_all($query);
//                 if (empty($result)) {
//                     $this->login = $login;
//                 } else {
//                     return false;
//                 }
//             }
//             if ($mail != NULL) {
//                 $request = "SELECT mail FROM utilisateurs WHERE login = '$mail'";
//                 $query = mysqli_query($this->connexion, $request);
//                 $result = mysqli_fetch_all($query);
//                 if (empty($result)) {
//                     $this->mail = $mail;
//                 } else {
//                     return false;
//                 }
//             }
//             if ($mdp != NULL) {
//                 $mpd = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 12));
//                 $request = "UPDATE utilisateurs SET mdp = '$mdp' WHERE id = " . $this->id . "";
//                 //var_dump($request);
//                 $query = mysqli_query($this->connexion, $request);
//             }
//             if ($prenom != NULL) {
//                 $this->prenom = $prenom;
//             }
//             if ($nom != NULL) {
//                 $this->nom = $nom;
//             }
//             $request = "UPDATE utilisateurs SET nom = '" . $this->nom . "',prenom = '" . $this->prenom . "', login = '" . $this->login . "',mail = '" . $this->mail . "'WHERE id = " . $this->id . "";
//             //var_dump($request);
//             $query = mysqli_query($this->connexion, $request);
//             //var_dump($query);
//         } else {
//             return false;
//         }
//     }
//     public function disconnect()
//     {
//         $this->id = NULL;
//         $this->nom = NULL;
//         $this->prenom = NULL;
//         $this->login = NULL;
//         $this->mail = NULL;
//         $this->permissions = NULL;
//     }
//     public function getid()
//     {
//         return $this->id;
//     }
//     public function isConnected()
//     {
//         if ($this->id != null) {
//             return true;
//         } else {
//             return false;
//         }
//     }

//     public function getlogin()
//     {
//         return $this->login;
//     }
//     public function getperm()
//     {
//         return $this->permissions;
//     }

//     public function getconnexion()
//     {
//         return $this->bdd;
//     }
}