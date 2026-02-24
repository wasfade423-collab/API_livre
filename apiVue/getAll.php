<?php
    //1- recupeartion des donnees
    $livres = $livre->getAll();
    if(is_array($livres)){//2- verification de la realisation effective de la requete
        $nombre = count($livres);
        if($nombre > 0){//si nombre = 0 alors aulivre nest trouvé dans la base de données
                $livres_get = array();
                $livres_get['data'] = [];
                //3- recupération et affectation des données de chaque Livre trouvé
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

                    //insertion du tableau formé dans le flux de sortie
                    array_push($livres_get['data'], $livre_get);
                }
                echo json_encode($livres_get);
        }else{
            echo json_encode(array("message"=>"Aucun livre pour le moment!"));
        }
    }else{//renvoie false si non éffectué.
        echo json_encode(["message"=>"Nous n'avons pas pu récupérer les Livres."]);
    }
?>