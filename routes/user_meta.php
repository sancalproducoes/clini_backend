<?php

// Rota para criar um novo registro de meta para o usuário
Flight::route('POST /user_meta', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $user_id = $data['user_id'];
    $meta_key = $data['meta_key'];
    $meta_value = $data['meta_value'];

    $stmt = $db->prepare("INSERT INTO cc_user_meta (user_id, meta_key, meta_value) VALUES (:user_id, :meta_key, :meta_value)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':meta_key', $meta_key);
    $stmt->bindParam(':meta_value', $meta_value);
    $stmt->execute();

    Flight::json(["message" => "Meta criada com sucesso"]);
});

// Rota para atualizar um registro de meta existente
Flight::route('PUT /user_meta/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $user_id = $data['user_id'];
    $meta_key = $data['meta_key'];
    $meta_value = $data['meta_value'];

    $stmt = $db->prepare("UPDATE cc_user_meta SET user_id = :user_id, meta_key = :meta_key, meta_value = :meta_value WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':meta_key', $meta_key);
    $stmt->bindParam(':meta_value', $meta_value);
    $stmt->execute();

    Flight::json(["message" => "Meta atualizada com sucesso"]);
});

// Rota para obter todas as metas associadas a um usuário específico
Flight::route('GET /user_meta/user/@user_id', function ($user_id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_user_meta WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $meta = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($meta);
});

// Rota para excluir uma meta específica
Flight::route('DELETE /user_meta/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_user_meta WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Meta excluída com sucesso"]);
});