<?php
// Rota para criar um novo espaço de trabalho (workspace)
Flight::route('POST /workspaces', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];
    $description = $data['description'];

    $stmt = $db->prepare("INSERT INTO cc_workspaces (name, description) VALUES (:name, :description)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    Flight::json(["message" => "Espaço de trabalho criado com sucesso"]);
});

// Rota para atualizar um espaço de trabalho (workspace) existente
Flight::route('PUT /workspaces/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];
    $description = $data['description'];

    $stmt = $db->prepare("UPDATE cc_workspaces SET name = :name, description = :description WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    Flight::json(["message" => "Espaço de trabalho atualizado com sucesso"]);
});

// Rota para obter todos os espaços de trabalho (workspaces)
Flight::route('GET /workspaces', function () {
    $db = Flight::db();
    $query = $db->query("SELECT * FROM cc_workspaces");
    $workspaces = $query->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($workspaces);
});

// Rota para obter um espaço de trabalho (workspace) específico
Flight::route('GET /workspaces/id/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_workspaces WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $workspace = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($workspace) {
        Flight::json($workspace);
    } else {
        Flight::halt(404, "Espaço de trabalho não encontrado");
    }
});

// Rota para obter um espaço de trabalho (workspace) específico
Flight::route('GET /workspaces/name/@name', function ($name) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_workspaces WHERE slug = :name");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $workspace = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($workspace) {
        Flight::json($workspace);
    } else {
        Flight::halt(404, "Espaço de trabalho não encontrado");
    }
});

// Rota para excluir um espaço de trabalho (workspace)
Flight::route('DELETE /workspaces/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_workspaces WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Espaço de trabalho excluído com sucesso"]);
});