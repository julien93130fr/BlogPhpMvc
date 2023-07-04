<?php

include './include/session.php';
require_once './model/auteur.php';

$page = 'inscription';

// isset test l' existence
if (isset($_POST['email'])) {

    // test si les 2 mdp sont identiques
    if ($_POST['password'] == $_POST['password2']) {


        // test pour vérifier le format de l' email 
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo 'format de mail invalide';
        } else {

            // on 
            $authorModel = new Auteur();

            if ($authorModel->getAllAuthorByEmail($_POST['email'])) {
                echo ' erreur ce compte existe déjà';
            } else {



                // insertion de l' auteur
                $passwordHash =  password_hash($_POST['password'], PASSWORD_BCRYPT);

                // on appell al méthode d insertion dans la bdd
                $authorModel->insertAuthor($_POST['email'], $passwordHash);

                // redirection du user
                header('location:connexion.php?inscription=ok');
            }
        }
    } else {
        echo ' vos deux mot de passe ne correspondent pas ';
    }
}



include_once './template_view/register.phtml';
