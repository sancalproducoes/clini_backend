<?php

// Rota para atribuir uma função (role) a um usuário
Flight::route('POST /user_role', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $user_id = $data['user_id'];
    $role_id = $data['role_id'];

    $stmt = $db->prepare("INSERT INTO cc_user_role (user_id, role_id) VALUES (:user_id, :role_id)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':role_id', $role_id);
    $stmt->execute();

    Flight::json(["message" => "Função atribuída ao usuário com sucesso"]);
});

// Rota para obter todas as funções (roles) atribuídas a um usuário
Flight::route('GET /user_role/user/@user_id', function ($user_id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT cc_roles.* FROM cc_roles INNER JOIN cc_user_role ON cc_roles.id = cc_user_role.role_id WHERE cc_user_role.user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($roles);
});

// Rota para excluir uma função (role) atribuída a um usuário
Flight::route('DELETE /user_role/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_user_role WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Função atribuída ao usuário excluída com sucesso"]);
});