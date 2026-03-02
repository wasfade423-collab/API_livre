<?php
//fichier de la méthode POST
    //1-on récupère le json object des informations.
    $datas  = json_decode(file_get_contents('php://input'));
    //2-L'objet livre instancier dans l'index prend les attriuts que contient l'objet JSON
    $livre->title = htmlspecialchars(strip_tags($datas->title));
    $livre->author = htmlspecialchars(strip_tags($datas->author));
    $livre->description = htmlspecialchars(strip_tags($datas->description));
    $livre->impressions = htmlspecialchars(strip_tags($datas->impressions));
    $livre->etoiles = htmlspecialchars(strip_tags($datas->etoiles));
    $livre->chemin = htmlspecialchars(strip_tags($datas->chemin));
    $livre->category_id = htmlspecialchars(strip_tags($datas->category_id));
    //3-Sauvegarde dans la base de données
    if($livre->create()){//si la sauvegarde bien éffectuée faire:
        echo json_encode(array("message"=>"Création effectée"));
    }else{//si la sauvegarde non éffectuée faire:
        echo json_encode(array("message"=>"Création non effectée"));
    }
?>