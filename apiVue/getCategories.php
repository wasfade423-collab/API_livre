<?php
    //1- recupeartion des donnees
    $categories = $categorie->getCategories();
    if(is_array($categories)){//2- verification de la realisation effective de la requete
        $nombre = count($categories);
        $categories_get = [];
        $categories_get['data'] = [];
        if($nombre>0){//si nombre = 0 alors aulivre nest trouvé dans la base de données
        //3- recupération et affectation des données de chaque Livre trouvé    
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
    }else{//renvoie false si non éffectué.
        echo json_encode(["message"=>"Requête non éffectuée."]);
    }
?>