<?php
    //1- recupeartion des donnees
    $livre_get = $livre->getOne($id);
    if(is_array($livre_get)){//2- verification de la realisation effective de la requete
        $data = [];
        $data['data'] = $livre_get;
        echo json_encode($data);
    }else{//renvoie false si non éffectué.
        echo json_encode(array("message"=>"Nous n'avons pas troouvé ce livre."));
    }
?>