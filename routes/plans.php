<?php

// Rota para criar um novo plano (plan)
Flight::route('POST /plans', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $stmt = $db->prepare("INSERT INTO cc_plans (name, description, price) VALUES (:name, :description, :price)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->execute();

    Flight::json(["message" => "Plano criado com sucesso"]);
});

// Rota para atualizar um plano (plan) existente
Flight::route('PUT /plans/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];
    $description = $data['description'];
    $price = $data['price'];

    $stmt = $db->prepare("UPDATE cc_plans SET name = :name, description = :description, price = :price WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->execute();

    Flight::json(["message" => "Plano atualizado com sucesso"]);
});

// Rota para obter todos os planos (plans)
Flight::route('GET /plans', function () {
    $db = Flight::db();
    $query = $db->query("SELECT * FROM cc_plans");
    $plans = $query->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($plans);
});

// Rota para obter um plano (plan) específico
Flight::route('GET /plans/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_plans WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $plan = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($plan) {
        Flight::json($plan);
    } else {
        Flight::halt(404, "Plano não encontrado");
    }
});

// Rota para excluir um plano (plan)
Flight::route('DELETE /plans/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_plans WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Plano excluído com sucesso"]);
});