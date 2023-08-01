<?php

// Rota para criar um novo dado (data)
Flight::route('POST /data', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $workspace_id = $data['workspace_id'];
    $data_type_id = $data['data_type_id'];
    $value = $data['value'];

    $stmt = $db->prepare("INSERT INTO cc_data (workspace_id, data_type_id, value) VALUES (:workspace_id, :data_type_id, :value)");
    $stmt->bindParam(':workspace_id', $workspace_id);
    $stmt->bindParam(':data_type_id', $data_type_id);
    $stmt->bindParam(':value', $value);
    $stmt->execute();

    Flight::json(["message" => "Dado criado com sucesso"]);
});

// Rota para atualizar um dado (data) existente
Flight::route('PUT /data/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $workspace_id = $data['workspace_id'];
    $data_type_id = $data['data_type_id'];
    $value = $data['value'];

    $stmt = $db->prepare("UPDATE cc_data SET workspace_id = :workspace_id, data_type_id = :data_type_id, value = :value WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':workspace_id', $workspace_id);
    $stmt->bindParam(':data_type_id', $data_type_id);
    $stmt->bindParam(':value', $value);
    $stmt->execute();

    Flight::json(["message" => "Dado atualizado com sucesso"]);
});

// Rota para obter todos os dados (data)
Flight::route('GET /data', function () {
    $db = Flight::db();
    $query = $db->query("SELECT * FROM cc_data");
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($data);
});

// Rota para obter um dado (data) específico
Flight::route('GET /data/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_data WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        Flight::json($data);
    } else {
        Flight::halt(404, "Dado não encontrado");
    }
});

// Rota para excluir um dado (data)
Flight::route('DELETE /data/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_data WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Dado excluído com sucesso"]);
});