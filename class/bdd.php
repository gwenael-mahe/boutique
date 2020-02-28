<?php

class bdd{

    protected $connexion;

    public function __construct(){
        $connect = mysqli_connect('Localhost', 'root', '', 'boutique');
        //var_dump($connect);
        if($connect == false){
            return false;
        }
        $this->connexion = $connect;
        //var_dump($this->connexion);
    }
    
    public function close(){
        mysqli_close($this->connexion);
    }
    public function getco(){
        return $this->connexion;
    }
}

?>