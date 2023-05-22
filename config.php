<?php

// Defina as configurações do banco de dados
//Flight::register('db', 'PDO', array('mysql:host=192.185.223.214;dbname=carita48_clinicare', 'carita48_clinicare', 'Jsdk6ccp.'), function($db) {
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=clinicare', 'root', ''), function($db) {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});

$encryption_key = getenv('encryption_key');
?>