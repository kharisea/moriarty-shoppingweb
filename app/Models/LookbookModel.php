<?php

namespace App\Models;

use CodeIgniter\Model;

class LookbookModel extends Model
{
    protected $table = 'lookbook';
    protected $useTimestamps = true;
    protected $createdField = "";
    protected $updatedField = "";
    protected $allowedFields = ['namalb', 'gambarp', 'gslide1', 'gslide2', 'gslide3'];

    public function getLookbook($id = false){
        if ($id == false){
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    
}