<?php
    if($livre->delete($id)){
        echo json_encode(array("message"=>"Suppression effectuée."));
    }else{
        echo json_encode(array("message"=>"Suppression effectuée."));
    }
?>