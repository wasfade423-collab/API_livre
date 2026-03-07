<?php
    
    //Je veux consommer une API en PHP
    //1- Quel est l'endpoint de l'API
    $url = "localhost:900/api/livres";

    //2- Je dois initialiser la session cURl

    $ch = curl_init($url);
    
    //3- Je dois définir le mode de transmission cURL 

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Si la recuperation à partir de cet endpoint n'est pas possible,    
    if(!curl_exec($ch)){
        die("Erreur: " . curl_error($ch));
    }
//fermé ensuite la session cURL    
    curl_close($ch);
//Sinon 
    $response = curl_exec($ch);
    //4- Je stocke alors les donnéés que renvoient l'endpoint dans (tableau par exemple)
    $datas = json_decode($response, true);
    var_dump($datas);

?>