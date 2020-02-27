<?php

class bdd{

    private $connexion;

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
    }
    
    public function close(){
        mysqli_close($this->connexion);
    }

    public function getco()
    {
        return $this->connexion;
    }

}