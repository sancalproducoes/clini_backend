<?php

// Rota para obter todos os usuários
Flight::route('GET /users', function () {
    $db = Flight::db();
    $query = $db->query("SELECT * FROM cc_users");
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($users);
});

//Rota para cadastrar um novo usuário
Flight::route('POST /users', function () {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];
    $lastname = $data['lastname'];
    $email = $data['email'];
    $password = $data['password'];

    $stmt = $db->prepare("INSERT INTO cc_users (name, lastname, email, password) VALUES (:name, :lastname, :email, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    Flight::json(["message" => "Usuário criado com sucesso"]);
});

// Rota para atualizar um usuário específico
Flight::route('PUT /users/@id', function ($id) {
    $db = Flight::db();
    $data = Flight::request()->data;
    $name = $data['name'];
    $lastname = $data['lastname'];
    $email = $data['email'];
    $password = $data['password'];

    $stmt = $db->prepare("UPDATE cc_users SET name = :name, lastname = :lastname, email = :email, password = :password WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    Flight::json(["message" => "Usuário atualizado com sucesso"]);
});

// Rota para deletar um usuário específico
Flight::route('DELETE /users/@id', function ($id) {
    $db = Flight::db();
    $stmt = $db->prepare("DELETE FROM cc_users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Flight::json(["message" => "Usuário excluído com sucesso"]);
});

?>