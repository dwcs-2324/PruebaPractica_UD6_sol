<?php
require 'util.php';
require 'CurlHelper.php';
// $result = CurlHelper::perform_http_request('GET', URL_BASE);
// procesarResponse($result);



// $result = CurlHelper::perform_http_request('GET', URL_BASE."/4");

// procesarResponse($result);

// $payload =  ["title" => "curl title 2"];
// $result = CurlHelper::perform_http_request('POST', URL_BASE, json_encode($payload) );
// procesarResponse($result);


$payload =  ["title" => "curl title put", "completed" => true];
$result = CurlHelper::perform_http_request('PUT', URL_BASE."/6", json_encode($payload) );
procesarResponse($result);
function procesarResponse($result){
    $result_json = json_decode($result, true);
    mostrar_json($result_json);
}