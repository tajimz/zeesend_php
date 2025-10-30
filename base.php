<?php


require_once("con.php");


function getDataFromJsonArray(){
    return json_decode(file_get_contents("php://input"), true)[0];

}

function getDataFromJsonObj(){
    $jsonFromRestApi = file_get_contents("php://input");
    if ($jsonFromRestApi == null) return null;
    $jsonFromRestApi = json_decode($jsonFromRestApi, true);
    return $jsonFromRestApi;
}



?>