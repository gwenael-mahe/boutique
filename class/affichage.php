<?php

include 'bdd.php'

class affichage{

    private $bdd;

    public function __construct()
    {
        $bdd = new bdd();
        $this->bdd = $bdd->getco();
    }
    public function product($id){
        $request = ""
    }
}

?>