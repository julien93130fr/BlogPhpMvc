<?php 

include './include/session.php';

$page = 'article';
// appel du fichier contenant la méthode débug
    require_once './debug.php';

// appel du fichier contenant la classe article
    require_once './model/article.php';


    
    // instanciation du model ( en tant que objet )
    $articleModel  = new Article();
    // appel de la méthode (getAllArticles) contenu
    $articles      = $articleModel->getAllArticle();

   // d($articles);

    // appel de la view
    include './template_view/article.phtml';


?>
