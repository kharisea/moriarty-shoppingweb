<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'users_sub_menu';
    protected $useTimestamps = true;
    protected $createdField = "";
    protected $updatedField = "";
    protected $allowedFields = ['title', 'menu_id', 'url', 'is_active'];

    public function getSubMenu(){   
        $query = "SELECT `users_sub_menu`.*, `users_menu`.`menu`
                    FROM `users_sub_menu` JOIN `users_menu`
                    ON `users_sub_menu`.`menu_id` = `users_menu`.`id`
                ";

       return $this->db->query($query)->getResultArray();
    }

    
}
?>





