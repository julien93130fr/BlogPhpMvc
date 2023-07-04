<?php

include './include/session.php';
require_once './model/auteur.php';
$page = 'connexion';
// 
if(isset($_POST['email']) && isset($_POST['password'])){

    // on va voir si un compte utilisateur existe par l' email 
    $authorModel = new Auteur();
    $author = $authorModel->getAuthorsByemail($_POST['email']);

    // si l utilisateur existe en bdd
    if(isset($author->email)){
        // on test sint mot de passe
        if(password_verify($_POST['password'],$author->mot_de_passe)) {
            
            session_start();
            $_SESSION['email'] = $_POST['email'];

            header('location:index.php');
        
    }else{
        echo '<p class = "alert_danger" > Mauvais couple identifiant / mot de passe. </p>';
    }
}else{
        echo '<p class = "alert_danger" > Mauvais couple identifiant / mot de passe. </p>';
}
}

include './template_view/connexion.phtml';