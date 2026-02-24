<?php
    $livresCategorie = $categorie->getLivresByCategorie($id);

    if(is_array($livresCategorie)){
        $livresC = [];
        $livresC["data"] = [];
        if(count($livresCategorie)>0){
            for($i=0; $i<count($livresCategorie); $i++){
                $livreC = [];
                $livreC['id'] = $livresCategorie[$i]['id'];
                $livreC['title'] = $livresCategorie[$i]['title'];
                $livreC['author'] = $livresCategorie[$i]['author'];
                $livreC['description'] = $livresCategorie[$i]['description'];
                $livreC['create_at'] = $livresCategorie[$i]['create_at'];
                $livreC['update_at'] = $livresCategorie[$i]['update_at'];
                $livreC['category_id'] = $livresCategorie[$i]['category_id'];
                $livreC['category_name'] = $livresCategorie[$i]['category_name'];
                $livreC['impressions'] = $livresCategorie[$i]['impressions'];
                $livreC['etoiles'] = $livresCategorie[$i]['etoiles'];     
                
                array_push($livresC['data'], $livreC);
            }
            echo json_encode($livresC);
        }else{
            echo json_encode(["message"=>"Aucun livres dans cette catégorie."]);
        }
    }else{
        echo json_encode(array("message"=>"Aucun livre pour le moment!"));
    }
?>