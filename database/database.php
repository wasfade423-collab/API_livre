<?php
    try{
        $database = new PDO("mysql:host=localhost; dbname=apiLivre; charset=utf8", 'root', '');
        $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }catch(Exception $e){
        echo json_encode($e->getMessage());
    }
?>