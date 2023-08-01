<?php

// Rota para criar um novo tipo de dado (data type)
Flight::route('POST /data_types', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];
    $description = $data['description'];

    $stmt = $db->prepare("INSERT INTO cc_data_types (name, description) VALUES (:name, :description)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    Flight::json(["message" => "Tipo de dado criado com sucesso"]);
});

// Rota para atualizar um tipo de dado (data type) existente
Flight::route('PUT /data_types/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];
    $description = $data['description'];

    $stmt = $db->prepare("UPDATE cc_data_types SET name = :name, description = :description WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    Flight::json(["message" => "Tipo de dado atualizado com sucesso"]);
});

// Rota para obter todos os tipos de dados (data types)
Flight::route('GET /data_types', function () {
    $db = Flight::db();
    $query = $db->query("SELECT * FROM cc_data_types");
    $data_types = $query->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($data_types);
});

// Rota para obter um tipo de dado (data type) específico
Flight::route('GET /data_types/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_data_types WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $data_type = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data_type) {
        Flight::json($data_type);
    } else {
        Flight::halt(404, "Tipo de dado não encontrado");
    }
});

// Rota para excluir um tipo de dado (data type)
Flight::route('DELETE /data_types/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_data_types WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Tipo de dado excluído com sucesso"]);
});