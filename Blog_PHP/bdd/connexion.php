<?php


            //require_once './debug.php';

function connect(){

        $connexion = new PDO("mysql:host=localhost;port=8889;dbname=blog","root","root");
 
        return $connexion;
}








?>