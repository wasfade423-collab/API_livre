<?php
    // création de la connexion PDO vers la base de données "apiLivre"
    try{
        $database = new PDO("mysql:host=localhost; dbname=apiLivre; charset=utf8", 'root', '');
        // désactive l'émulation des requêtes préparées pour utiliser les vraies
        $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }catch(Exception $e){
        // retourne l'erreur en JSON si la connexion échoue
        echo json_encode($e->getMessage());
    }
?>