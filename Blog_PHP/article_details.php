<?php 
 
    include './include/session.php';

    require_once './debug.php';
    require_once './model/article.php';

$id = htmlspecialchars($_GET['id']);

$articleModel   = new Article();
$article        = $articleModel->getArticle($id);



$category = $articleModel->getCategoryByArticleId($id);





include_once './template_view/article_detail.phtml';
