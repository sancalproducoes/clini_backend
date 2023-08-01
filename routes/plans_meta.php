<?php

// Rota para criar um novo metadado de plano (plan meta)
Flight::route('POST /plan_meta', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $plan_id = $data['plan_id'];
    $meta_key = $data['meta_key'];
    $meta_value = $data['meta_value'];

    $stmt = $db->prepare("INSERT INTO cc_plan_meta (plan_id, meta_key, meta_value) VALUES (:plan_id, :meta_key, :meta_value)");
    $stmt->bindParam(':plan_id', $plan_id);
    $stmt->bindParam(':meta_key', $meta_key);
    $stmt->bindParam(':meta_value', $meta_value);
    $stmt->execute();

    Flight::json(["message" => "Metadado de plano criado com sucesso"]);
});

// Rota para atualizar um metadado de plano (plan meta) existente
Flight::route('PUT /plan_meta/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $plan_id = $data['plan_id'];
    $meta_key = $data['meta_key'];
    $meta_value = $data['meta_value'];

    $stmt = $db->prepare("UPDATE cc_plan_meta SET plan_id = :plan_id, meta_key = :meta_key, meta_value = :meta_value WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':plan_id', $plan_id);
    $stmt->bindParam(':meta_key', $meta_key);
    $stmt->bindParam(':meta_value', $meta_value);
    $stmt->execute();

    Flight::json(["message" => "Metadado de plano atualizado com sucesso"]);
});

// Rota para obter todos os metadados de planos (plan meta) de um plano específico
Flight::route('GET /plan_meta/plan/@plan_id', function ($plan_id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_plan_meta WHERE plan_id = :plan_id");
    $stmt->bindParam(':plan_id', $plan_id);
    $stmt->execute();
    $plan_meta = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($plan_meta);
});

// Rota para obter um metadado de plano (plan meta) específico
Flight::route('GET /plan_meta/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_plan_meta WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $plan_meta = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($plan_meta) {
        Flight::json($plan_meta);
    } else {
        Flight::halt(404, "Metadado de plano não encontrado");
    }
});

// Rota para excluir um metadado de plano (plan meta)
Flight::route('DELETE /plan_meta/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_plan_meta WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Metadado de plano excluído com sucesso"]);
});