<?php

include './include/session.php';

$page = 'auteur';

// appel du fichier contenant la méthode débug
    require_once './debug.php';
// appel du fichier contenant la classe auteur
    require_once './model/auteur.php';


    $auteurModel = new Auteur();


    $auteurs = $auteurModel->getAllAuteur();

    include_once './template_view/auteur.phtml';