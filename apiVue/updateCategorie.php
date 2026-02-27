<?php
    //recuperation des informations envoyées par celui qui effectue la modification.
    $datas = json_decode(file_get_contents("php://input"));
    $categorie->category_name = htmlspecialchars(strip_tags($datas->category_name));
    $categorie->description = htmlspecialchars(strip_tags($datas->description));

    if($categorie->updateCategory($id)){
        echo json_encode(array("message"=>"Categoire de Livre modifiée."));
    }else{
        echo json_encode(array("message"=>"Categoire de Livre n'a pas été modifiée."));    
    }
?>