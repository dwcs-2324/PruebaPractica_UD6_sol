<?php


use Symfony\Component\HttpClient\HttpClient;

require '../vendor/autoload.php';
require 'util.php';
//requiere una dependencia composer require symfony/http-client


$client = HttpClient::create();

//getOne($client, 1);

//getAll($client);

//create($client, ["title"=> "Compra 28/02"]);

// updateTotal($client, ["title"=> "Nueva put 28/02", "completed"=> true], 6);

// updateParcial($client, ["title" => "Nueva patch 28/02"], 6);

//deleteNota($client, 15);
function deleteNota($client, $id)
{
    $response = $client->request(
        'DELETE',
        URL_BASE . "/$id"
    );

    procesarResponse($response);
}

function getOne($client, $id)
{
    $response = $client->request(
        'GET',
        URL_BASE . "/$id"
    );

    procesarResponse($response);
}

function getAll($client)
{

    $response = $client->request(
        'GET',
        URL_BASE
    );

    procesarResponse($response);
}


function create($client, $data)
{


    $response = $client->request('POST', URL_BASE, [
        'json' => $data
    ]);
    procesarResponse($response);
}
function updateParcial($client, $data, $id)
{

    $response = $client->request('PATCH', URL_BASE . "/$id", [
        'json' => $data
    ]);

    procesarResponse($response);
}


function updateTotal($client, $data, $id)
{


    $response = $client->request('PUT', URL_BASE . "/$id", [
        'json' => $data
    ]);
    procesarResponse($response);
}






function procesarResponse($response)
{
    //obtener código respuesta
    $statusCode = $response->getStatusCode();
    // $statusCode = 200
    echo $statusCode;
    echo "<br/>";

    $content = $response->getContent(); //obtiene un String
    if (!empty($content)) {
        $content = $response->toArray(); // se transforma a un array asociativo

        mostrar_json($content);




        // $contentType = 'application/json'
        $contentType = $response->getHeaders()['content-type'][0];
        echo $contentType;
        echo "<br/>";
    }
}


