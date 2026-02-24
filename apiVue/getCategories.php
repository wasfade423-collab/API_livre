<?php
    $categories = $categorie->getCategories();
    if(is_array($categories)){
        $nombre = count($categories);
        $categories_get = [];
        $categories_get['data'] = [];
        if($nombre>0){
            for($i = 0; $i<$nombre; $i++){
                $categorie_get  = [];
                $categorie_get['id'] = $categories[$i]['id'];
                $categorie_get['category_name'] = $categories[$i]['category_name'];
                $categorie_get['description'] = $categories[$i]['description'];
                array_push($categories_get['data'], $categorie_get);
            }
            echo json_encode($categories_get);
        }else{
            echo json_encode(["message"=>"Aucune catégorie pour le moment."]); 
        }
    }else{
        echo json_encode(["message"=>"Requête non éffectuée."]);
    }
?>