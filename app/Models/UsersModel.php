<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    
    protected $allowedFields = ['email', 'username', 'password', 'role', 'created_at', 'updated_at'];

    //otomatis mengisi kolom created_at dan updated_at
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    // protected $updatedField  = 'updated_at';

    // // Validasi untuk input pengguna
    // protected $validationRules = [
    //     'username' => 'required|alpha_numeric_space|min_length[3]',
    //     'password' => 'required|min_length[8]',
    //     'role'     => 'required|in_list[admin,user]',
    // ];

    // // Pesan kesalahan
    // protected $validationMessages = [
    //     'username' => [
    //         'required' => 'Username is required',
    //         'alpha_numeric_space' => 'Username can only contain alphanumeric characters and spaces',
    //         'min_length' => 'Username must be at least 3 characters long'
    //     ],
    //     'password' => [
    //         'required' => 'Password is required',
    //         'min_length' => 'Password must be at least 8 characters long'
    //     ],
    //     'role' => [
    //         'required' => 'Role is required',
    //         'in_list' => 'Role must be either admin or user'
    //     ]
    // ];

    // Menghapus field tertentu agar tidak dikembalikan dalam query
    // protected $skipValidation = false;
}