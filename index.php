<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Origin, X-Reqested-With, Authorization');
    include_once('core/initialize.php');

    $livre     = new Livres($database);
    
    $categorie = new categories($database);

    $method    = $_SERVER['REQUEST_METHOD'];

    $url       = $_SERVER['REQUEST_URI'];
    $url       = str_replace("/api/", "", $url);

    $request  = explode('/', trim($url, '/'));

    $ressource = $request[0];
    $id        = $request[1] ?? null; 

    if($method === "OPTIONS"){
        http_response_code(200);
        exit;
    }else{
        if($ressource === "livres"){
            switch($method){
                case "GET" : {
                    if($id === null){
                        //getAll
                        include_once("apiVue/getAll.php");
                    }else{
                        if(ctype_digit($id)){
                            //getOne
                            include_once("apiVue/getOne.php");
                        }else{
                            echo json_encode(["message"=>"Endpoint incorrect."]);
                        }
                    }
                    break;
                }
                case "PUT" : {
                    if($id === null){
                        echo json_encode(["message"=>"Endpoint incorrect."]);
                    }else{
                        if(ctype_digit($id)){
                            //modifieOne
                            include_once("apiVue/update.php");
                        }else{
                            echo json_encode(["message"=>"Endpoint incorrect."]);
                        }
                    }
                    break;
                }
                case "POST" : {
                    if($id === null){
                        include_once("apiVue/create.php");
                    }else{
                        echo json_encode(["message"=>"Endpoint incorrect."]);
                    }
                    break;
                } 
                case "DELETE" : {
                    if($id === null){
                        echo json_encode(["message"=>"Endpoint incorrect."]);
                    }else{
                        if(ctype_digit($id)){
                            //delete
                            include_once("apiVue/delete.php");
                        }else{
                            echo json_encode(["message"=>"Endpoint incorrect."]);
                        }
                    }
                    break;
                } 
                default : {
                    http_response_code(405);
                    echo json_encode(["message"=>"Methode non autorisée."]);
                    break;
                } 
            } 
        }elseif($ressource === "categories"){
            switch($method) {
                case "GET" :{
                    if($id === null){
                        include_once("apiVue/getCategories.php");
                    }elseif(ctype_digit($id)){
                        include_once("apiVue/getLivreCategorie.php");
                    }else{
                        echo json_encode(["message"=>"Endpoint incorrect."]);
                    }
                }
            }
        }else{
            echo json_encode(["message"=>"Endpoint incorrect."]);
        }
    }


?>