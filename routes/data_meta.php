<?php

// Rota para criar um novo metadado (data meta)
Flight::route('POST /data_meta', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $data_id = $data['data_id'];
    $meta_key = $data['meta_key'];
    $meta_value = $data['meta_value'];

    $stmt = $db->prepare("INSERT INTO cc_data_meta (data_id, meta_key, meta_value) VALUES (:data_id, :meta_key, :meta_value)");
    $stmt->bindParam(':data_id', $data_id);
    $stmt->bindParam(':meta_key', $meta_key);
    $stmt->bindParam(':meta_value', $meta_value);
    $stmt->execute();

    Flight::json(["message" => "Metadado criado com sucesso"]);
});

// Rota para atualizar um metadado (data meta) existente
Flight::route('PUT /data_meta/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $data_id = $data['data_id'];
    $meta_key = $data['meta_key'];
    $meta_value = $data['meta_value'];

    $stmt = $db->prepare("UPDATE cc_data_meta SET data_id = :data_id, meta_key = :meta_key, meta_value = :meta_value WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':data_id', $data_id);
    $stmt->bindParam(':meta_key', $meta_key);
    $stmt->bindParam(':meta_value', $meta_value);
    $stmt->execute();

    Flight::json(["message" => "Metadado atualizado com sucesso"]);
});

// Rota para obter todos os metadados (data meta) de um dado específico
Flight::route('GET /data_meta/data/@data_id', function ($data_id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_data_meta WHERE data_id = :data_id");
    $stmt->bindParam(':data_id', $data_id);
    $stmt->execute();
    $data_meta = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($data_meta);
});

// Rota para obter um metadado (data meta) específico
Flight::route('GET /data_meta/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_data_meta WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $data_meta = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data_meta) {
        Flight::json($data_meta);
    } else {
        Flight::halt(404, "Metadado não encontrado");
    }
});

// Rota para excluir um metadado (data meta)
Flight::route('DELETE /data_meta/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_data_meta WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Metadado excluído com sucesso"]);
});