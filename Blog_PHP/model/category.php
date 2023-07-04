<?php

require_once './bdd/connexion.php';

    class Category{

        public function GetAllCategory(){
             // appel la function d une connexion a la bdd
        $connexion = connect();

        // préparation de la requete
        $query = $connexion->prepare("SELECT * 
                                        FROM categorie");

        // execution
        $query->execute();

        // récupere les résultats
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        // return le résultat
        return $result;


        }


    }


    