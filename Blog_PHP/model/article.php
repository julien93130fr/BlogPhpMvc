<?php

// requiére la base de données
require_once './bdd/connexion.php';


// définition de la classe 
class Article{

        // définition d' une méthode
    public function getAllArticle(){


      

        // appel la function d une connexion a la bdd
        $connexion = connect();

        // préparation de la requete
        $query = $connexion->prepare("SELECT * FROM article");

        // execution
        $query->execute();

        // récupere les résultats
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // return le résultat
        return $result;

       // d($result);
    }

    public function get3LastArticle(){

           // appel la function d une connexion a la bdd
           $connexion = connect();

           // préparation de la requete
           $query = $connexion->prepare("SELECT * 
                                            FROM `Article`  
                                            ORDER BY`date_publication`
                                            LIMIT 3;");
   
           // execution
           $query->execute();
   
           // récupere les résultats
           $result = $query->fetchAll(PDO::FETCH_OBJ);
   
           // return le résultat
           return $result;
    }
    
    public function randomArticle(){

        $conn = connect();
        $query = $conn->prepare("SELECT * 
        FROM article ORDER BY RAND() LIMIT 1");
        
       
        $query->execute();
        
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;

       
        
       


        
    }

    public function getArticle($id){

            // appel la function d une connexion a la bdd
            $connexion = connect();

            // préparation de la requete
            $query = $connexion->prepare("SELECT *
                                        FROM article 
                                            JOIN auteur ON auteur.id_auteur = article.id_auteur
                                            
                                        WHERE id_article = :id");
    
            $query->bindValue('id',$id);
            
            // execution de la requete;
            $query->execute();
    
            // récupere les résultats
            $result = $query->fetch(PDO::FETCH_OBJ);
    
            // return le résultat
            return $result;

    }

    public function insertArticle($data):int{
        
        // appel la function d une connexion a la bdd
        $connexion = connect();

        // préparation de la requete
        $query = $connexion->prepare("INSERT INTO  article 
                                                     (`titre`,
                                                     `contenu`,
                                                     `image`,
                                                     `video`,
                                                     `id_auteur`,
                                                     `date_publication`)
        /* Chargement des valeurs avec : devant ,exemple :image
        */
                                         VALUES
                                            (:titre,
                                             :contenu,
                                             :image,
                                             :video,
                                             :id_auteur,
                                             :date_publication)");

        // on rajoute du htmlspecialchars protection contre l injection de code 
        $query->bindValue('titre',htmlspecialchars($data['titre']));
        $query->bindValue('contenu',htmlspecialchars($data['contenu']));
        $query->bindValue('image',htmlspecialchars($data['image']));
        $query->bindValue('video',htmlspecialchars($data['video']));
        $query->bindValue('id_auteur',htmlspecialchars($data['id_auteur']));
        $query->bindValue('date_publication',date ('Y-m-d H:i:s'));
        



        $query->execute();
        // recuperation du dernier id generer en bdd
        return $connexion->lastInsertId();

       
 }


    public function insertCategoryArticle($idArticle, $categorys){
       
                 $connexion = connect();

        foreach($categorys as $key => $value){
            $query = $connexion->prepare("INSERT INTO  posseder 
                                                (`id_article`,
                                                `id_categorie`)
                                            VALUES
                                                (:id_article,
                                                :id_Category)");
                                                
            $query->bindValue('id_article',$idArticle);
            $query->bindValue('id_Category', $value);

            $query->execute();

    }

    }

    public function updateArticle($data){

        // appel la function d une connexion a la bdd
        $connexion = connect();

        // préparation de la requete
        $query = $connexion->prepare("
                                UPDATE  article
                                SET titre = :titre,
                                contenu = :contenu,
                                video = :video,
                                id_auteur = :idAuteur,
                                date_publication = :datePublication
                                WHERE id_article = :id");

    
        //on rajoute du htmlspecialchars pour eviter l'attaque XSS
        $query->bindValue('id',htmlspecialchars($data['id']));
        $query->bindValue('titre',htmlspecialchars($data['titre']));
        $query->bindValue('contenu',htmlspecialchars($data['contenu']));
        $query->bindValue('video',htmlspecialchars($data['video']));
        $query->bindValue('idAuteur',htmlspecialchars($data['id_auteur']));
        $query->bindValue('datePublication',date ('Y-m-d H:i:s'));
    
        $query->execute();

        //Supprimer les catégories lié a l' article
        $query = $connexion->prepare("DELETE FROM posseder WHERE id_article = :id");
        $query->bindValue('id', htmlspecialchars($data['id']));
        $query->execute();

        // reinsertion des nouvelles données
        $this->insertCategoryArticle($data['id'], $data['category']);


    


    }

    // Création de la function  deleteArticle
    public function deleteArticle($id){

     // appel la function d une connexion a la bdd
        $connexion = connect();

        // Préparation de la requete 
         $query = $connexion->prepare(" 
        DELETE FROM posseder
        WHERE id_article = :id");
        
        //on rajoute du htmlspecialchars pour eviter l'attaque XSS
        $query->bindValue('id',htmlspecialchars($id));
        
        // Exécution de la requete   
        $query->execute();



        // appel la function d une connexion a la bdd
        $connexion = connect();

        // Préparation de la requete 
        $query = $connexion->prepare(" 
                                        DELETE FROM article
                                        WHERE id_article = :id");
     
        //on rajoute du htmlspecialchars pour eviter l'attaque XSS
        $query->bindValue('id',htmlspecialchars($id));
   
        // Exécution de la requete   
           $query->execute();


    
     
        }

        public function getCategoryByArticleId($id):array{

            $connexion = connect();

            // préparation de la requete
            $query = $connexion->prepare("SELECT * 
                                             FROM posseder
                                             JOIN categorie ON categorie.id_categorie = posseder.id_categorie  
                                             WHERE posseder.id_article = :id
                                             ");

            $query->bindValue('id',$id);
            // execution
            $query->execute();
            // récupere les résultats
            $result = $query->fetchAll(PDO::FETCH_OBJ);
    
            return $result;
        }

        public function getArticleByCategoryId($idCategory) {
            $conn = connect();
            $query = $conn->prepare("SELECT * 
                                    FROM article
                                    JOIN posseder ON posseder.id_article = article.id_article
                                        JOIN categorie ON categorie.id_categorie = posseder.id_categorie 
                                    WHERE posseder.id_categorie = :idCategory
                                    ");
            $query->bindValue('idCategory', $idCategory);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }

}


