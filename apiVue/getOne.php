<?php

    $livre_get = $livre->getOne($id);
    if(is_array($livre_get)){
        $data = [];
        $data['data'] = $livre_get;
        echo json_encode($data);
    }else{
        echo json_encode(array("message"=>"Nous n'avons pas troouvé ce livre."));
    }
?>