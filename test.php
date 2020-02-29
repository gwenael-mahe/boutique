<?php

include 'class/bdd.php';
include 'class/achat.php';
include 'class/affichage.php';

session_start();
echo '<h1>Page de Test</h1>';


$affi = new affichage();
// $affi->product(1);
$affi->notation(1);
// $affi->commentaire(1);
// $affi->addcommentaire(1,"blablabla",1,1);

// $achat = new achat();
// $achat->__construct();
// $achat->addtocart(1,1,1);
// var_dump($achat);


?>