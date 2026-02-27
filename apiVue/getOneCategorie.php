<?php
    // récupération d'une catégorie spécifique par id
    if(is_array($categorie->getOneCategorie($id))){
        $datasGet = $categorie->getOneCategorie($id);
        $categoriesGet = [];
        $categoriesGet["data"] = $datasGet;
        echo json_encode($categoriesGet);
    }else{
        echo json_encode(array("message"=>"Nous n'avons pas troouvé cette Catégorie de Livre.."));
    }
?>