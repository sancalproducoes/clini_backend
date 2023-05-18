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
    $key = '02042eb47e50ab1e64844f91f3fa6c36a03de41720ece4746e40fc94172b3a46';
    // Consulta o banco de dados para verificar as credenciais do usuário
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM users WHERE email = :username AND password = AES_ENCRYPT(:password, :encryption_key)");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->bindParam(':encryption_key', $key);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    // Verifica se o usuário foi encontrado no banco de dados
    if (!$user) {
        Flight::halt(401);
    }
});



Flight::start();
?>