<?php
    if($livre->delete($id)){//si l'operation de supression est effectuée faire:
        echo json_encode(array("message"=>"Suppression effectuée."));
    }else{//si l'operation de supression n'a pas pu être effectuée faire:
        echo json_encode(array("message"=>"Suppression effectuée."));
    }
?>