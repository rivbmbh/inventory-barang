<?php

namespace App\Controllers;
use App\Models\UsersModel;

class Home extends BaseController
{    
    public function index()
    {
        $session = session();
        $modelUser = new UsersModel();
        $data = [
            'title' => 'Dashboard',
            'subtitle' => 'Dashboard',
            'tableTitle' => 'Welcome&nbsp;' . ucwords($session->get('username')),
            'dataUsers' => $modelUser->findAll(),
        ];

        return view('dashboard', $data);
    }
}