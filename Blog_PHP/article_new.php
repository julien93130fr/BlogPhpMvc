<?php

    include './include/session.php';

    $page = 'new';

    if(!isset($_SESSION['email'])){
            header('location:index.php');
    }


// chargement du model article
require_once './model/article.php';
// chargement du model auteur
require_once './model/auteur.php';
require_once './model/category.php';


if(isset($_POST['titre'])){
    $data = $_POST;

    // pour tricher en attendant de traiter l' image.
   // $data['image'] = 'image.jpg';

   if (isset($_FILES['photo'])) {

        $typeAuthoryse = [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif'
        ];
        // on testy si le type de la photo existe dans le tableau des types que l' on autorise
        if(in_array ($_FILES['photo']['type'], $typeAuthoryse)){
        
            // on test la taille de la photo
            if($_FILES['photo']['size'] <= (1048576 * 2)){

  
             // on extrait l extension  du fichier
            $extension = explode(".", $_FILES['photo']['name']);



            // ON COPIE LE FICHIER TEMPORAIRE DANS LE DOSSIER SOUHAITÉ DANS NOTRE PROJET
            $newDestination = './photo/'.uniqid().'.'.$extension[count($extension )-1 ];
            move_uploaded_file($_FILES['photo']['tmp_name'], $newDestination);

            $data['image'] = $newDestination;

            $articleModel = new Article();
            $idArticle = $articleModel->insertArticle($data);

            $articleModel->insertCategoryArticle($idArticle,$_POST['category']);

          



             header("location:articles.php");
        }else{
                echo '<span style="color:red;">photo trop volumineuse </span>';
        }

        }else{
            echo ' <span style="color:red;">le fichier n est pas pris en charge</span>';
        
        }
               //$data['titre'] = htmlspecialchars($data['titre']);
}   
    

       //$articleModel = new Article();
      //$articleModel->insertArticle($data);
    /*
    *  redirection si l' insertion s' est bien passé 
    *  avec la méthode intégrer  "header" suivi de "location:"
    *  et mettre l' endroit ou la redirection va se faire 
    */
      

         



}


    $auteurModel    = new Auteur();
    $authorList     = $auteurModel->getAllAuteur();

    $categoryModel  = new Category();
    $categoryList   = $categoryModel->GetAllCategory();


// inclure le template phtml
include_once './template_view/article_new.phtml';




