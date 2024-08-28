<?php

namespace App\Models;
use CodeIgniter\Model;

class ItemsModel extends Model{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    
    protected $allowedFields = ['name', 'description', 'stock', 'created_at'];
}