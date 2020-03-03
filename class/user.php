<?php

class user
{

    private $bdd;

    private $id;
    private $login;
    private $mail;
    private $lastmessage;

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
                    $this->lastmessage = 'Ce login / mail est déjà utilisé';
                }
            } else {
                $this->lastmessage = 'Les deux mots de passe sont différents';
            }
        } else {
            $this->lastmessage = 'Veuillez remplir tous les champs';
        }
    }

    public function connexion($login, $mdp)
    {
        $requete = "SELECT * FROM user WHERE login = '$login'";
        $query = mysqli_query($this->bdd, $requete);
        $result = mysqli_fetch_assoc($query);
        if (!empty($result)) {
            if (password_verify($mdp, $result["password"])) {
                $this->id = $result["id"];
                $this->login = $result["login"];
                $this->mail = $result["mail"];
                header('location:profil.php');
            } else {
                $this->lastmessage = 'Erreur de mot de passe';
            }
        } else {
            $this->lastmessage = 'Ce login n\' existe pas';
        }
    }

    public function profil($id, $confmdp, $login, $mail, $mdp = '')
    {
        $request = "SELECT password FROM user WHERE id = " . $id . "";
        $query = mysqli_query($this->bdd, $request);
        $fetchmdp = mysqli_fetch_assoc($query);

        if (password_verify($confmdp, $fetchmdp["password"])) {
            if ($login != NULL) {
                $request = "SELECT id,login FROM user WHERE login = '$login'";
                $query = mysqli_query($this->bdd, $request);
                $result = mysqli_fetch_assoc($query);
                if (empty($result)) {
                    $this->login = $login;
                } elseif ($result['id'] == $id) {
                    $this->login = $login;
                } else {
                    $this->lastmessage = 'Ce login est déjà utilisé';
                }
            }
            if ($mail != NULL) {
                $request = "SELECT id,mail FROM user WHERE mail = '$mail'";
                $query = mysqli_query($this->bdd, $request);
                $result = mysqli_fetch_assoc($query);
                if (empty($result)) {
                    $this->mail = $mail;
                } elseif ($result['id'] == $id) {
                    $this->mail = $mail;
                } else {
                    $this->lastmessage = 'Ce mail correspond déjà à un utilisateur';
                }
            }
            if ($mdp != NULL) {
                $mdp = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 12));
                $request = "UPDATE user SET password = '$mdp' WHERE id = " . $id . "";
                $query = mysqli_query($this->bdd, $request);
            }
            if (!isset($this->lastmessage)) {
                $request = "UPDATE user SET login = '" . $this->login . "', mail = '" . $this->mail . "' WHERE id = " . $id . "";
                $query = mysqli_query($this->bdd, $request);
                $this->lastmessage = 'Modification prise en compte';
            }
        } else {
            $this->lastmessage = 'Vieux mot de passe erroné';
        }
    }

    public function disconnect()
    {
        session_destroy();
        //('location:index');
    }

    public function getlastmessage()
    {
        return $this->lastmessage;
    }

    public function getlogin()
    {
        return $this->login;
    }

    public function getmail()
    {
        return $this->mail;
    }

    public function getid()
    {
        return $this->id;
    }
}
