<?php
require 'flight/flight.php';
require 'config.php';
require 'dao/dao.php';
require 'routes/routes.php';

// Função de autenticação
Flight::before('start', function(&$params, &$output){
    // Verifica se o header de autenticação está presente
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        Flight::halt(401);
    }
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];
    $key = getenv('encryption_key');
    // Consulta o banco de dados para verificar as credenciais do usuário
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM users WHERE email = :username AND password = AES_ENCRYPT(:password, :encryption_key)");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->bindParam(':encryption_key', $key);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        Flight::halt(401);
    }
});



Flight::start();
?>