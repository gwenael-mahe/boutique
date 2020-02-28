<?php

include 'class/achat.php';

session_start();
echo '<h1>Page de Test<h1/>';
if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}

// $achat = new achat();
// $achat->__construct();
// $achat->addtocart(1,1,1);
// var_dump($achat);


?>