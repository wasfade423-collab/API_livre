<?php
    $livreComming = json_decode(file_get_contents('php://input'));
    $livre->title = $livreComming->title;
    $livre->description = $livreComming->description;
    $livre->author = $livreComming->author;
    $livre->impressions = $livreComming->impressions;
    $livre->etoiles = $livreComming->etoiles;

    $id = $_GET['id'];

    if($livre->update($id)){
        echo json_encode(array("message"=>"Modification effectée"));
    }else{
        echo json_encode(array("message"=>"Modification non effectée"));
    }


?>