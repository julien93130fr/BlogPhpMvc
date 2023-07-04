<?php 
    include './include/session.php';

        $page = 'index';
// appel du fichier contenant la méthode débug
    require_once './debug.php';

// appel du fichier contenant la classe article
    require_once './model/article.php';


    
    // instanciation du model ( en tant que objet )
    $articleModel  = new Article();

                              //  $categoryModel = new Category();

    // appel de la méthode (getAllArticles) contenu
    //$articles      = $articleModel->getAllArticle();

    // appel de la méthode (get3LastArticle) contenu dans l' objet article
    $articles      = $articleModel->get3LastArticle();


    $randomArticles = $articleModel->randomArticle();

                          //   $categorys = $categoryModel->getAllCategory();
    
 

    // appel de la view
    include_once './template_view/index.phtml';


?>

