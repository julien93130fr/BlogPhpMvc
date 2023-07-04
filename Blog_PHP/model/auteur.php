<?php

// requiére la base de données
require_once './bdd/connexion.php';

class Auteur
{

    public function getAllAuteur(): array
    {

        // appel la function d une connexion a la bdd
        $connexion = connect();

        // préparation de la requete
        $query = $connexion->prepare("SELECT *
                                         FROM `Auteur`
                                         limit 4;");

        // execution
        $query->execute();

        // récupere les résultats
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        // return le résultat
        return $result;
    }

    public function getAuthorsByemail($email):object{

        $connexion = connect();
           // préparation de la requete
        $query = $connexion->prepare("SELECT *
        FROM `Auteur`
        WHERE email = :email");

        $query->bindValue('email', htmlspecialchars($email));

        // execution
        $query->execute();

        // récupere les résultats
        $result = $query->fetch(PDO::FETCH_OBJ);
        if(empty($result)){
            return new stdClass();
        }
        return $result;


    }

    public function insertAuthor($email, $password): void
    {
        // appel la function d une connexion a la bdd
        $conn = connect();

        // préparation de la requete
        $query = $conn->prepare("INSERT INTO auteur 
                                   (`email`, `mot_de_passe`)
                                    VALUES (:email, :mot_de_passe)");;


        $query->bindValue('email', htmlspecialchars($email));
        $query->bindValue('mot_de_passe', htmlspecialchars($password));
        $query->execute();
    }


    public function getAllAuthorByEmail($email): bool
    {
        // appel la function d une connexion a la bdd
        $connexion = connect();

        // préparation de la requete
        $query = $connexion->prepare("SELECT *
                                      FROM `Auteur`
                                      WHERE email = :email");

        $query->bindValue('email', htmlspecialchars($email));

        // execution
        $query->execute();

        // récupere les résultats
        $result = $query->fetch(PDO::FETCH_OBJ);
       
        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }
}
