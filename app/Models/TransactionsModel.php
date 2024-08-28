<?php

namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class TransactionsModel extends Model{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    
    protected $allowedFields = ['item_id', 'user_id', 'type', 'quantity', 'transaction_date'];
    
    public function getData()
    {
        return $this->select('transactions.*, users.username as user_name, items.name as item_name')
        ->join('users', 'users.id = transactions.user_id')
        ->join('items', 'items.id = transactions.item_id')
        ->findAll();
    }
}