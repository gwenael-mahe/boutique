<?php

include 'class/bdd.php';
include 'class/achat.php';
include 'class/affichage.php';

session_start();
echo '<h1>Page de Test</h1>';

session_destroy();
// $affi = new affichage();
// $affi->panier(1);
// $affi->product(1);
// $affi->notation(1);
// $affi->commentaire(1);
// $affi->addcommentaire(1,"blablabla",1,1);

// $achat = new achat();
// $achat->addtohistory(1,$achat->pricecalculation(1));
// $achat->sendmail(1,6);
// echo $achat->pricecalculation(1);
// $achat->__construct();
// $achat->addtocart(1,1,1);
// var_dump($achat);


?>