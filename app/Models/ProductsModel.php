<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'harga', 'stok', 'ukuran', 'sampul'];

    public function getProducts($id = false){
        if ($id == false){
            return $this;
        }

        return $this->where(['id' => $id])->first();
    }

    public function search($keyword){
        return $this->table('products')->like('nama', $keyword)->orLike('harga', $keyword);
    }
}
