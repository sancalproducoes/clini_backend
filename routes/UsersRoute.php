<?php

    // Rota /users
    Flight::route('GET /users', function(){
        $usersDao = new UsersDao();
        $users = $usersDao->getAllUsers();
        Flight::json($users);
    });

    Flight::route('GET /users/email/@email', function($email){
        $usersDao = new UsersDao();
        $users = $usersDao->getUserByEmail($email);
        Flight::json($users);
    });

    Flight::route('GET /users/id/@id', function($id){
        $usersDao = new UsersDao();
        $users = $usersDao->getUserById($id);
        Flight::json($users);
    });

    //EDITAR USUARIO
    Flight::route('PATCH /users', function(){
        $body = Flight::request()->data;
        $usersDao = new UsersDao();
        $users = $usersDao->editUser($body);
        Flight::json($users);
    });

    Flight::route('POST /users/profile_pic', function(){
        $usersDao = new UsersDao();
        $users = $usersDao->editUserProfilePic();
        Flight::json($users);
    });

    Flight::route('GET /users/@id/image', function($id){
        $usersDao = new UsersDao();
        $users = $usersDao->getUserImage($id);
        Flight::json($users);
    });

    //Get users data
    Flight::route('GET /users/id/@id/workspaces', function($id){
        $usersDao = new UsersDao();
        $users = $usersDao->getWorkspacesByUserId($id);
        Flight::json($users);
    });




?>