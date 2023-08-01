<?php

// Rota para criar uma nova função (role)
Flight::route('POST /role', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];
    $description = $data['description'];

    $stmt = $db->prepare("INSERT INTO cc_roles (name) VALUES (:name)");
    $stmt->bindParam(':name', $name);
    $stmt->execute();

    Flight::json(["message" => "Função criada com sucesso"]);
});

// Rota para atualizar uma função (role) existente
Flight::route('PUT /role/id/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];

    $stmt = $db->prepare("UPDATE cc_roles SET name = :name WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->execute();

    Flight::json(["message" => "Função atualizada com sucesso"]);
});

// Rota para obter todas as funções (roles)
Flight::route('GET /roles', function () {
    $db = Flight::db();
    $query = $db->query("SELECT * FROM cc_roles");
    $roles = $query->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($roles);
});

// Rota para obter uma função (role) específica
Flight::route('GET /role/id/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_roles WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $role = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($role) {
        Flight::json($role);
    } else {
        Flight::halt(404, "Função não encontrada");
    }
});

// Rota para excluir uma função (role)
Flight::route('DELETE /role/id/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_roles WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Função excluída com sucesso"]);
});