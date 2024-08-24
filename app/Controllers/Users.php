<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        $modelUser = new UsersModel();
        $data = [
            'title' => 'User | Page',
            'subtitle' => 'ADMIN PAGE',
            'tableTitle' => 'Tabel Users',
            'dataUsers' => $modelUser->findAll(),
        ];
        echo view('users_view', $data);
    }

    public function addUser()
    {
        $modelUser = new UsersModel();
        $data = [
            'title' => 'Add User | Page',
            'subtitle' => 'ADMIN PAGE',
            'tableTitle' => 'Form Add User',
        ];

         //cek req method POST
        if($this->request->getMethod() === 'POST'):
            $dataUser = [
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role'),
                // 'password' => $this->request->getPost('password'),
            ];
            $modelUser->save($dataUser);
        endif;
        echo view('users_add', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login | Page',
            'subtitle' => 'Login PAGE',
            'tableTitle' => 'Form Login',
        ];
        echo view('login.php', $data);
    }

    public function registration()
    {
        $data = [
            'title' => 'Registration | Page',
            'subtitle' => 'Registration PAGE',
            'tableTitle' => 'Form Registration',
        ];
        echo view('registration.php', $data);
    }
}