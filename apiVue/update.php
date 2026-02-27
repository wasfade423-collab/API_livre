<?php
//fichier de la method PUT
    //1-on récupère le json object des informations.
    $livreComming = json_decode(file_get_contents('php://input'));
    //2-L'objet livre instancier dans l'index prend les attriuts que contient l'objet JSON
    $livre->title = $livreComming->title;
    $livre->description = $livreComming->description;
    $livre->author = $livreComming->author;
    $livre->impressions = $livreComming->impressions;
    $livre->etoiles = $livreComming->etoiles;
    //3-Sauvegarde dans la base de données
    if($livre->update($id)){//si la sauvegarde bien éffectuée faire:
        echo json_encode(array("message"=>"Modification effectée"));
    }else{//si la sauvegarde non éffectuée faire:
        echo json_encode(array("message"=>"Modification non effectée"));
    }


?>