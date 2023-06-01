<?php 

 function check_access($role_id, $menu_id){
    $db = \Config\Database::connect();

    $results = $db->query("SELECT * FROM `users_access_menu`
                            WHERE `role_id` = $role_id AND `menu_id` = $menu_id");

    if($results->getNumRows() > 0){
        return "checked='checked'";
    }

}

?>