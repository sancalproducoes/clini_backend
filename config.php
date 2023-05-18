<?php

// Defina as configurações do banco de dados
Flight::register('db', 'PDO', array('mysql:host=192.185.223.214;dbname=carita48_clinicare', 'carita48_clinicare', 'Jsdk6ccp.'), function($db) {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});

$encryption_key = '02042eb47e50ab1e64844f91f3fa6c36a03de41720ece4746e40fc94172b3a46';
$GLOBALS['encryption_key'] = $encryption_key;
?>