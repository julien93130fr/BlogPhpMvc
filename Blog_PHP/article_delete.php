<?php


require_once './model/article.php';

    // recuperation de l id dans l url

    $id = htmlspecialchars($_GET['id']);


    // instanciation du model article

    $articleModel = new Article();

    // supprimer la photo en relation avec l' article 
    $article = $articleModel->getArticle(($id));
    // je teste si la valeur  n est pas vide is si le fichier n' existe pas 
    if (!empty($article->$image) && is_file($article->$image)) {
        // je supprime le fichier sur le serveur
        unlink($article->$image);
    }
   
    // appelle de la methode suppression dans la class article par rapport a l id 

    $article = $articleModel->deleteArticle($id);

    // redirection de l' utilisateur vers la page articles;php
    header("location:articles.php");