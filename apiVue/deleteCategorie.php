<?php
    // suppression d'une catégorie via la méthode DELETE
    if($categorie->deleteCategorie($id)){//si l'operation de supression est effectuée faire:
        echo json_encode(array("message"=>"Categoire de Livre supprimée."));
    }else{//si l'operation de supression n'a pas pu être effectuée faire:
        echo json_encode(array("message"=>"Categoire de Livre n'a pas été supprimée."));
    }
?>