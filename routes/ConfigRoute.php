<?php

Flight::route('GET /login/@workspace_id', function($workspace_id){
    $usersDao = new UsersDao();
    $users = $usersDao->getCurrentUser($workspace_id);
    Flight::json($users);
});
?>