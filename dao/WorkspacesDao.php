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

        function getUsersWorkspacesById($id){
            $db = Flight::db();
            $query = $db->prepare("SELECT 
            w.*
        FROM 
            users as u
        LEFT JOIN
            users_workspaces as uw
        ON u.id = uw.user_id
        INNER JOIN
            workspaces as w
        ON w.id = uw.workspace_id
        where u.id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            $workspaces = $query->fetchAll(PDO::FETCH_ASSOC);
            return $workspaces;
        }

        function getWorkSpacesLocalUsersByWorkSpaceIDComplete($id){
            $db = Flight::db();
            $query = $db->prepare("SELECT 
            lu.*
        FROM 
            local_users as lu 
        WHERE 
            lu.workspace_id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            $workspaces = $query->fetchAll(PDO::FETCH_ASSOC);
            if($workspaces){
                for($i = 0; $i < count($workspaces); $i++){
                    $workspaces[$i]['profile_pic'] = base64_encode($workspaces[$i]['profile_pic']);
                    $workspaces[$i]['password'] = '';
                }
                return $workspaces;
            }else{
                return array("success"=> false, "message"=> "Nenhum usuário foi encontrado");;
            }
        }

        function getWorkSpacesLocalUsersByWorkSpaceIDInfo($id){
            $db = Flight::db();
            $query = $db->prepare("SELECT 
            lu.id,
            lu.name,
            lu.lastname,
            lu.email,
            lu.workspace_id,
            lu.profile_type,
            lu.status,
            lu.carreer,
            lu.address,
            lu.address_number,
            lu.address_obs,
            lu.address_neighbor,
            lu.address_city,
            lu.address_state,
            lu.address_zipcode,
            lu.creation_dt,
            lu.update_dt
        FROM 
            local_users as lu 
        WHERE 
            lu.workspace_id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            $workspaces = $query->fetchAll(PDO::FETCH_ASSOC);
            if($workspaces){
                return $workspaces;
            }else{
                return array("success"=> false, "message"=> "Nenhum usuário foi encontrado");;
            }
        }
    }

?>