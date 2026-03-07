<?php
    // en-têtes CORS et type de contenu pour répondre en JSON
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Origin, X-Reqested-With, Authorization');
    // chargement des classes et initialisation de la DB
    include_once('core/initialize.php');

    $headers = getallheaders();

    if(!isset($headers['Authorization']) || $headers['Authorization'] !== Authorization){
        http_response_code(401);

        echo json_encode(["message"=>"Token absent ou invalide."]);

        exit();
    }else{
        $api_key = str_replace("First ", "", $headers['Authorization']);

        if(empty($api_key) || $api_key !== API_KEY){
            http_response_code(401);

            echo json_encode(["message"=>"Clé API absente ou incorrect."]);

            exit();//exit pour dire que si l'utilisation n'a pas ou n'a pa renseigné le bon API_KEY il est automatique sortir.
        }
    
    }



    // création des objets métiers avec la connexion partagée
    $livre     = new Livres($database);
    
    $categorie = new categories($database);

    // méthode HTTP reçue
    $method    = $_SERVER['REQUEST_METHOD'];

    // décompose l'URL pour extraire ressource et identifiant
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
                        include_once("apiVue/getOneCategorie.php");
                        include_once("apiVue/getLivresCategorie.php");
                    }else{
                        echo json_encode(["message"=>"Endpoint incorrect."]);
                    }
                    break;
                }
                case "POST" :{
                    if($id === null){
                        include_once("apiVue/createCategorie.php");
                    }else{
                        echo json_encode(["message"=> "Endpoint incorrect."]);
                    }
                    break;
                }
                case "PUT" :{
                    if($id === null){
                        echo json_encode(["message"=> "Endpoint incorrect."]);
                    }else{
                        if(ctype_digit($id)){
                            include_once("apiVue/updateCategorie.php");
                        }else{
                            echo json_encode(["message"=> "Endpoint incorrect."]);
                        }
                    }
                    break;
                }      
                case "DELETE" :{
                    if($id === null){
                        echo json_encode(["message"=> "Endpoint incorrect."]);
                    }else{
                        if(ctype_digit($id)){
                            include_once("apiVue/deleteCategorie.php");
                        }else{
                            echo json_encode(["message"=> "Endpoint incorrect."]);
                        }
                    }
                    break;
                }                           
            }
        }else{
            echo json_encode(["message"=>"Endpoint incorrect."]);
        }
    }


?>