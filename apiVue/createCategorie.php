<?php
    // création d'une nouvelle catégorie (POST)
    // on récupère les données JSON envoyées par le client
    $datas = json_decode(file_get_contents("php://input"));

    $categorie->category_name = htmlspecialchars(strip_tags($datas->category_name));
    $categorie->description = htmlspecialchars(strip_tags($datas->description));
    
    if($categorie->createCategorie()){
        echo json_encode(array("message"=>"Categoire de Livre crée."));
    }else{
        echo json_encode(array("message"=>"Categoire de Livre n'a pas été crée."));
    }
?>