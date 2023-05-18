<?php

    class WorkSpacesDao{
        function getAllWorkspaces(){
            $db = Flight::db();
            $query = $db->query("SELECT * FROM workspaces");
            $workspaces = $query->fetchAll(PDO::FETCH_ASSOC);
            return $workspaces;
        }

        function getWorkspacesById($id){
            $db = Flight::db();
            $query = $db->prepare("SELECT * FROM workspaces WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            $workspaces = $query->fetchAll(PDO::FETCH_ASSOC);
            return $workspaces;
        }
    }

?>