<?php
namespace My\ApiClient;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\HttpClient;



class ApiClient{
    private CurlHttpClient  $cliente;

    private static string $base_url;

    public function __construct(string $url) {
        self::$base_url = $url;
        $this->cliente = HttpClient::create();
    }

    public function read(int $id){
        $response = $this->cliente->request(
            'GET',
            self::$base_url . "/$id"
        );

        $this->procesarResponse($response);
    
    }

    // public function update(array $data){
    //     $response = $this->cliente->request(
    //         'PUT',
    //         self::$base_url . "/{$data["id"]}", 
    //         [
    //             'json' => $data
    //         ]
    //     );

    //     $this->procesarResponse($response);
    // }


    private function procesarResponse($response)
    {
        //obtener código respuesta
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        echo $statusCode;
        echo "<br/>";
    
        $content = $response->getContent(); //obtiene un String
        if (!empty($content)) {
            $content = $response->toArray(); // se transforma a un array asociativo
    
            $this->mostrar_json($content);
    
            // $contentType = 'application/json'
            $contentType = $response->getHeaders()['content-type'][0];
            echo $contentType;
            echo "<br/>";
        }
    }

    private function mostrar_json($content){
        echo "<pre>";
        echo json_encode($content, JSON_PRETTY_PRINT);
        echo "</pre>";
    }

}