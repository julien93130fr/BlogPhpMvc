<?php

    include './include/session.php';
    
    require_once './model/article.php';
    require_once './model/auteur.php';
    require_once './model/category.php';

    $id = htmlspecialchars($_GET['id']);

    $articleModel   = new Article();
    $article        = $articleModel->getArticle($id);


    $auteurModel    = new Auteur();
    $authorList     = $auteurModel->getAllAuteur();

      // recuper la liste des categories
      $categoryModel = new Category ();
      $categoryList = $categoryModel->GetAllCategory();

    // recup des categories lié a l article
    $tabIdCategoryArticle = [];
    $categoryListArticle = $articleModel->getCategoryByArticleId($id);
    foreach($categoryListArticle as $row){
        $tabIdCategoryArticle[] = $row->id_categorie;
    }

  

if(isset($_POST['titre'])){
    $data = $_POST;

   // $articleModel = new Article();
    $articleModel->updateArticle($data);

    //redirection si l' insertion c est bien passé
     header("location:articles.php");
}


include_once './template_view/article_update.phtml';

?>