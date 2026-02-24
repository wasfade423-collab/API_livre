<?php
    $livres = $livre->getAll();
    $nombre = count($livres);
    if($nombre > 0){
            $livres_get = array();
            $livres_get['data'] = [];
            for($i = 0 ; $i < $nombre; $i++){
                $livre_get = [];
                $livre_get['id'] = $livres[$i]['id'];
                $livre_get['title'] = $livres[$i]['title'];
                $livre_get['author'] = $livres[$i]['author'];
                $livre_get['description'] = $livres[$i]['description'];
                $livre_get['create_at'] = $livres[$i]['create_at'];
                $livre_get['update_at'] = $livres[$i]['update_at'];
                $livre_get['category_id'] = $livres[$i]['category_id'];
                $livre_get['category_name'] = $livres[$i]['category_name'];
                $livre_get['impressions'] = $livres[$i]['impressions'];
                $livre_get['etoiles'] = $livres[$i]['etoiles'];
                array_push($livres_get['data'], $livre_get);
            }
            echo json_encode($livres_get);
    }else{
        echo json_encode(array("message"=>"Aucun livre pour le moment!"));
    }
?>