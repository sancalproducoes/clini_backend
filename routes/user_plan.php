<?php

// Rota para criar um novo relacionamento entre usuário e plano (user plan)
Flight::route('POST /user_plan', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $user_id = $data['user_id'];
    $plan_id = $data['plan_id'];
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];

    $stmt = $db->prepare("INSERT INTO cc_user_plan (user_id, plan_id, start_date, end_date) VALUES (:user_id, :plan_id, :start_date, :end_date)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':plan_id', $plan_id);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();

    Flight::json(["message" => "Relacionamento usuário-plano criado com sucesso"]);
});

// Rota para atualizar um relacionamento entre usuário e plano (user plan) existente
Flight::route('PUT /user_plan/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $user_id = $data['user_id'];
    $plan_id = $data['plan_id'];
    $start_date = $data['start_date'];
    $end_date = $data['end_date'];

    $stmt = $db->prepare("UPDATE cc_user_plan SET user_id = :user_id, plan_id = :plan_id, start_date = :start_date, end_date = :end_date WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':plan_id', $plan_id);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();

    Flight::json(["message" => "Relacionamento usuário-plano atualizado com sucesso"]);
});

// Rota para obter todos os relacionamentos entre usuários e planos (user plans) de um usuário específico
Flight::route('GET /user_plan/user/@user_id', function ($user_id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_user_plan WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user_plans = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($user_plans);
});

// Rota para obter um relacionamento entre usuário e plano (user plan) específico
Flight::route('GET /user_plan/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_user_plan WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user_plan = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_plan) {
        Flight::json($user_plan);
    } else {
        Flight::halt(404, "Relacionamento usuário-plano não encontrado");
    }
});

// Rota para excluir um relacionamento entre usuário e plano (user plan)
Flight::route('DELETE /user_plan/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_user_plan WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Relacionamento usuário-plano excluído com sucesso"]);
});