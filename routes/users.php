<?php

// Rota para obter todos os usuários
Flight::route('GET /users', function () {
    $db = Flight::db();
    $query = $db->query("SELECT * FROM cc_users");
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($users);
});

// Rota para obter usuario pelo id
Flight::route('GET /user/id/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($user);
});

// Rota para obter usuario pelo id
Flight::route('GET /user/email/@email', function ($email) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($user);
});

//Rota para cadastrar um novo usuário
Flight::route('POST /user', function () {
    $db = Flight::db();

    $name = Flight::request()->data->name;
    $lastname = Flight::request()->data->lastname;
    $email = Flight::request()->data->email;
    $password = Flight::request()->data->password;
    $stmt = $db->prepare("INSERT INTO cc_users (name, lastname, email, password) VALUES (:name, :lastname, :email, md5(:password))");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    Flight::json(["message" => "Usuário criado com sucesso"]);
});

// Rota para atualizar um usuário específico
Flight::route('PUT /user/@id', function ($id) {
    $db = Flight::db();
    $name = Flight::request()->data->name;
    $lastname = Flight::request()->data->lastname;
    $email = Flight::request()->data->email;
    $password = Flight::request()->data->password;
    $stmt = $db->prepare("UPDATE cc_users SET name = :name, lastname = :lastname, email = :email, password = md5(:password) WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    Flight::json(["message" => "Usuário atualizado com sucesso"]);
});

// Rota para deletar um usuário específico
Flight::route('DELETE /user/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Usuário excluído com sucesso"]);
});

// Rota para buscar todos os usuários de um workspace
Flight::route('GET /users/workspace/id/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("SELECT * FROM cc_users INNER JOIN cc_user_workspaces ON user_id = cc_users.id WHERE workspace_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($users);
});

?>