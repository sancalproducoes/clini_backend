<?php

// Substitua essas credenciais de banco de dados pelas suas
$db_host = '192.185.223.214';
$db_user = 'carita48_sancal';
$db_pass = 'jsdk6ccp';
$db_name = 'carita48_clinicare_v2';

// Inicializa a conexão com o banco de dados
Flight::register('db', 'PDO', array("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass), function($db) {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});


// Função para verificar as credenciais de autenticação no banco de dados
function authenticate($username, $password) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT password FROM cc_users WHERE email = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && md5($password)== $result['password']) {
        return true;
    }

    return false;
}

// Middleware para verificar as credenciais antes de executar as rotas protegidas
Flight::before('start', function () {
    $username = null;
    $password = null;

    if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];
    } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        // Para algumas configurações de servidor, as credenciais são enviadas pelo header "Authorization"
        list($type, $encoded) = explode(' ', $_SERVER['HTTP_AUTHORIZATION'], 2);
        if (strcasecmp($type, 'basic') === 0) {
            list($username, $password) = explode(':', base64_decode($encoded));
        }
    }

    if (!authenticate($username, $password)) {
        // Se as credenciais não forem válidas, envie o cabeçalho de autenticação novamente
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        header('HTTP/1.0 401 Unauthorized');
        echo "Acesso não autorizado.";
        exit();
    }
});

?>