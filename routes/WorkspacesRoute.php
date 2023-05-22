<?php

    Flight::route('GET /workspaces', function(){
        $workspaces = new WorkSpacesDao();
        $data = $workspaces->getAllWorkspaces();
        Flight::json($data);
    });

    Flight::route('GET /workspaces/id/@id', function($id){
        $workspaces = new WorkSpacesDao();
        $data = $workspaces->getWorkspacesById($id);
        Flight::json($data);
    });

    //USERS WORKSPACE BY ID

    Flight::route('GET /workspaces/user/@id', function($id){
        $workspaces = new WorkSpacesDao();
        $data = $workspaces->getUsersWorkspacesById($id);
        Flight::json($data);
    });

    //LOCALUSERS FROM WORKSPACE BY WORKSPACE ID
    Flight::route('GET /workspaces/id/@id/localusers', function($id){
        $workspaces = new WorkSpacesDao();
        $data = $workspaces->getWorkSpacesLocalUsersByWorkSpaceIDInfo($id);
        Flight::json($data);
    });

    Flight::route('GET /workspaces/id/@id/localusers/complete', function($id){
        $workspaces = new WorkSpacesDao();
        $data = $workspaces->getWorkSpacesLocalUsersByWorkSpaceIDComplete($id);
        Flight::json($data);
    });
?>