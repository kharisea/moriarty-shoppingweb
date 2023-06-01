<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $updatedField = "";
    protected $allowedFields = ['email', 'name', 'gambar', 'password', 'role_id', 'is_active'];

}
