<?php

    Flight::route('GET /workspaces', function(){
        $workspaces = new WorkSpacesDao();
        $data = $workspaces->getAllWorkspaces();
        Flight::json($data);
    });

    Flight::route('GET /workspaces/@id', function($id){
        $workspaces = new WorkSpacesDao();
        $data = $workspaces->getWorkspacesById($id);
        Flight::json($data);
    });

?>