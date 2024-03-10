<?php
use My\ApiClient\ApiClient;

require '../vendor/autoload.php';

try {
    $apiClient = new ApiClient("https://reqres.in/api/users");
    $userId = 14;
    $apiClient->read($userId);
} catch (Exception $e) {
    echo "Ha ocurrido una exception: " . $e->getMessage();
}


