<?php

class bdd{

    private $connexion;

    public function connect(){
        $connect = mysqli_connect('Localhost', 'root', '', 'rncp');
        //var_dump($connect);
        if($connect == false){
            return false;
        }
        $this->connexion = $connect;
    }
    
    public function close(){
        mysqli_close($this->connexion);
    }
}

?>