<?php
    $datas  = json_decode(file_get_contents('php://input'));
    $livre->title = htmlspecialchars(strip_tags($datas->title));
    $livre->author = htmlspecialchars(strip_tags($datas->author));
    $livre->description = htmlspecialchars(strip_tags($datas->description));
    $livre->impressions = htmlspecialchars(strip_tags($datas->impressions));
    $livre->etoiles = htmlspecialchars(strip_tags($datas->etoiles));

    if($livre->create()){
        echo json_encode(array("message"=>"Création effectée"));
    }else{
        echo json_encode(array("message"=>"Création non effectée"));
    }
?>