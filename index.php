<?php
require 'flight/Flight.php';
require 'config.php';
require 'routes/routes.php';
// Permitir que qualquer origem acesse a API (Apenas para desenvolvimento local)
header("Access-Control-Allow-Origin: *");

// Permitir os métodos HTTP listados abaixo
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Permitir os cabeçalhos listados abaixo
header("Access-Control-Allow-Headers: Authorization, Content-Type");

// Definir a quantidade de tempo que as informações de pré-voo (preflight) podem ser armazenadas em cache
header("Access-Control-Max-Age: 86400");

// Permitir o envio de cookies e credenciais de autenticação
header("Access-Control-Allow-Credentials: true");

// Se a requisição é uma opção de requisição, retorne imediatamente com um status de sucesso (200)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
Flight::start();